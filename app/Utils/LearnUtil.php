<?php

namespace App\Utils;
use Illuminate\Http\Request;
use App\Models\Learn;
use App\Models\LearnLibrary;
use App\Models\User;
use DataTables;
use Session;
use Str;
use DB;
use File;

Class LearnUtil
{
    public function index($request)
    {
        $learnVideos =  Learn::query();
        if($request->search)
        {
            $learnVideos->where('title', 'like', '%'.$request->search.'%');
        }
        $learnVideos->with('learn_library');
        $learnVideos->has('learn_library');
        $learnVideos->where('plan_id', auth()->user()->plan_id);
        $learnVideos->orderBy('sequence_no', 'asc');
        return $learnVideos = $learnVideos->get();
    }
    public function learnVideosList($request, $learnVideos)
    {
        $response = [];
        foreach($learnVideos as $learn){

            $existImage = store_learn_path(). $learn->learn_library->url;
            if (File::exists($existImage)) {
                $learn->learn_library->url = learn_public_path().$learn->learn_library->url;
            }
            $Arr = [
                'title'    => $learn->title,
                'description'    => $learn->description,
                'learn_library_id' => $learn->learn_library->id,
                'sequence_no' => $learn->sequence_no,
                'url' => $learn->learn_library->url,
                'file_name' => $learn->learn_library->file_name
            ];
            array_push($response, $Arr);
        }
        return $response;
    }
}