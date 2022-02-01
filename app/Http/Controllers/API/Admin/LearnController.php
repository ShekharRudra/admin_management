<?php

namespace App\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use App\Models\Learn;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LearnController extends Controller
{
    public function learnDatatable(Request $request) {
        $Learn = Learn::query();
        if(@$request->learn_library_id != "") {
            $Learn->where('mst_learn.learn_library_id','=',$request->learn_library_id);
        }
        if(@$request->plan_id != "") {
            $Learn->where('mst_learn.plan_id','=',$request->plan_id);
        }
        if(@$request->title != "") {
            $Learn->where('mst_learn.title','like',$request->title);
        }
        if(@$request->is_active  != "") {
            $Learn->where('mst_learn.is_active','=',$request->is_active);
        } 
        $LearnData = $Learn->select('mst_learn.id','mll.url','mll.id as learn_library_id','mp.id as plan_id','mp.plan_name' ,'mst_learn.title','mst_learn.description','mst_learn.sequence_no','mst_learn.is_active','mst_learn.created_at')
            ->leftjoin('mst_learn_library as mll', 'mll.id', '=', 'mst_learn.learn_library_id')
            ->leftjoin('mst_plan as mp', 'mp.id', '=', 'mst_learn.plan_id')
            ->orderBy('mst_learn.id', 'desc')
            ->get();
        foreach ($LearnData as $kData => $vData) {
            $LearnData[$kData]->url = responseMediaLink($vData->url, 'Video');
        }
        return Datatables::of($LearnData)->make(true);
    }
    public function learnVideoDatatable(Request $request) {
        $LearnVideoData = DB::table('mst_learn_library')->select('id', 'file_name','url as videoLink','created_at')
        ->orderBy('id', 'desc')
        ->get();
        foreach ($LearnVideoData as $kData => $vData) {
            $LearnVideoData[$kData]->videoLink = responseMediaLink($vData->videoLink, 'Video');
        }
        return Datatables::of($LearnVideoData)->make(true);
    }
    public function getLearnVideo(Request $request) {
        $videoList= DB::table('mst_learn_library')->orderBy('id', 'asc')->get();
        return response([
            'success' => config('constants.validResponse.success'),
            'message' => 'Data get successfully',
            'data'    => $videoList,
        ], config('constants.validResponse.statusCode'));

    }
    public function updateOrCreateLearn(Request $request) {
        $data = $request->validate([
            'video_library' => 'required',
            'plan' => 'required',
            'title'    => 'required',
            'sequence_no' => 'required',
        ]);
        $Sequence_No_Exist = Learn::where('id', '!=', $request->learn_id)
            ->where('sequence_no', '=', $request->sequence_no)
            ->count();
        if ($Sequence_No_Exist > 0) {
            return response([
                'success' => config('constants.invalidResponse.success'),
                'message' => 'Sequence already in use please choose another one',
                'data'    => [],
            ], config('constants.invalidResponse.statusCode'));

        }
        $Learn = Learn::updateOrCreate(
            ['id' => $request->learn_id], [
                'learn_library_id' =>$request->video_library,
                'plan_id' => $request->plan,
                'title'    => $request->title,
                'description' => $request->description,
                'sequence_no' => $request->sequence_no,
            ]);
        DB::commit();
        if ($Learn) {
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => (@$request->learn_id == '') ? "Learn added successfully" : "Learn updated successfully",
                'data'    => [],
            ], config('constants.validResponse.statusCode'));

        } else {
            return response([
                'success' => config('constants.invalidResponse.success'),
                'message' => 'Something went wrong',
                'data'    => [],
            ], config('constants.invalidResponse.statusCode'));

        }

    }

    public function learnChangeStatus(Request $request) {
        $data = $request->validate([
            'learn_id' => 'required',
        ]);
        $parameterValue = DB::update('update mst_learn set is_active=1-is_active where id="' . $request->learn_id . '"');
        if ($parameterValue) {
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => 'Status updated successfully',
                'data'    => [],
            ], config('constants.validResponse.statusCode'));

        } else {
            return response([
                'success' => config('constants.invalidResponse.success'),
                'message' => 'Something went wrong',
                'data'    => [],
            ], config('constants.invalidResponse.statusCode'));

        }

    }
    public function deleteLearn(Request $request) {
        $data = $request->validate([
            'learn_id' => 'required',
        ]);
        $parameterValue = Learn::where('id', '=', $request->learn_id)->delete();
        if ($parameterValue) {
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => 'Learn deleted successfully',
                'data'    => [],
            ], config('constants.validResponse.statusCode'));

        } else {
            return response([
                'success' => config('constants.invalidResponse.success'),
                'message' => 'Something went wrong',
                'data'    => [],
            ], config('constants.invalidResponse.statusCode'));

        }

    }
    public function deleteLearnVideo(Request $request) {
        $data = $request->validate([
            'learn_library_id' => 'required',
        ]);
        $VideoUrl = DB::table('mst_learn_library')->select('url')
        ->where('id', '=', $request->learn_library_id)
        ->first();
        if($VideoUrl){
          $removeVideo = removeFile($VideoUrl->url, 'Video');
          $Delete= DB::table('mst_learn_library')->where('id', '=', $request->learn_library_id)->delete();
          if ($Delete) {
              return response([
                  'success' => config('constants.validResponse.success'),
                  'message' => 'Video deleted successfully',
                  'data'    => [],
              ], config('constants.validResponse.statusCode'));
  
          } else {
              return response([
                  'success' => config('constants.invalidResponse.success'),
                  'message' => 'Something went wrong',
                  'data'    => [],
              ], config('constants.invalidResponse.statusCode'));
  
          }

        }else{
            return response([
                'success' => config('constants.invalidResponse.success'),
                'message' => 'Something went wrong',
                'data'    => [],
            ], config('constants.invalidResponse.statusCode')); 
        }
        

    }
    public function uploadVideo(Request $request) {
        $data = $request->validate([
            'selectVideo' => 'required',
        ]);
        $fname = $_FILES['selectVideo']['name'];
        $ext = pathinfo($fname, PATHINFO_EXTENSION);
        if ($request->hasFile('selectVideo')) {
            $fname = $_FILES["selectVideo"]["name"];
            $ext = pathinfo($fname, PATHINFO_EXTENSION);
            $NewFileName = time().'_'.str_replace(' ', '', $fname);
            if (strtolower($ext) == "mp4") {
                $File_Url = uploadFile($request->file('selectVideo'), 'Video','vid1',$NewFileName);
            }else{
                return response([
                    'success' => config('constants.invalidResponse.success'),
                    'message' => 'Invalid file format',
                    'data' => [],
                ], config('constants.invalidResponse.statusCode'));
            }
        }
        $Insert = DB::insert('insert into mst_learn_library set url="'.$File_Url.'",file_name="'.$fname.'",created_at="'.date('Y-m-d H:i:s').'"');
        if ($Insert) {
            return response([
                'success' => config('constants.validResponse.success'),
                'message' =>"Uploaded",
                'data'    => [],
            ], config('constants.validResponse.statusCode'));

        } else {
            return response([
                'success' => config('constants.invalidResponse.success'),
                'message' => 'Something went wrong',
                'data'    => [],
            ], config('constants.invalidResponse.statusCode'));

        }


    }


}
