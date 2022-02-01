<?php

namespace App\Http\Controllers\API\Unique;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use DataTables;
use DB;

class ContactController extends Controller
{
    /* create contact us details */
    public function store(Request $request)
    {
        return self::createAndUpdateContactUs($request);
    }

    //unique createAndUpdateChurch
    public function createAndUpdateContactUs($request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);
        DB::beginTransaction();
        try
        {   
            $contactUs = ContactUs::updateOrCreate([
                'user_id' => auth()->user()->id,
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message
            ]);
            DB::commit();

            $notificationArray = [
                'user_id'  => auth()->user()->id,
                'title'    => 'Touch us',
                'description' => auth()->user()->user_name.' Sended a message to '.env('APP_NAME').'.',
                'screen_no' => 1,
                'created_by'=> auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            DB::table('mst_user_notification')->insert($notificationArray);

            if($contactUs)
            {
                $bodyHTML= [
                    'name' => $contactUs->name,
                    'email' => $contactUs->email,
                    'message' => $contactUs->message,
                    'subject' => 'Contact Us',
                    'view'=>'contact_us'
                ];
                mailSend($bodyHTML);

                return response([
                    'success' => config('constants.validResponse.success'),
                    'message' => 'Details sent done.',
                    'data' => $contactUs
                ], config('constants.validResponse.statusCode'));
            }
            return response([
                'success' => config('constants.invalidResponse.success'),
                'message' => 'Details sent not done',
                'data'    => [],
            ], config('constants.invalidResponse.statusCode'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage(),
                'data'    => config('constants.emptyData'),
            ], config('constants.invalidResponse.statusCode'));
        }
    }

    /* Touch us admin show datatable list*/
    public function touchUsDatatable(Request $request) {
        $touch =  ContactUs::query();        
        if(@$request->name != "") {
            $touch->where('name','like', '%'.$request->name.'%');
        }
        
        if(@$request->email != "") {
            $touch->where('email', 'like', '%'.$request->email.'%');
        }
        
        if(@$request->is_read != '') {
            $touch->where('is_read','=',$request->is_read);
        }
        
        $touch = $touch->select('id', 'name', 'user_id', 'email','is_read','created_at')
        ->orderBy('id', 'desc')
        ->get();
        
        return Datatables::of($touch)->make(true);
    }

    public function touchUsDelete(Request $request)
    {
        $this->validate($request, [
            'touch_us_id' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $contactUs = ContactUs::find($request->touch_us_id);
            if($contactUs)
            {
                $contactUs->delete();
                DB::commit();
                return response([
                    'success' => config('constants.validResponse.success'),
                    'message' => 'Details deleted.'
                ], config('constants.validResponse.statusCode'));
            }
            return response([
                'success' => config('constants.invalidResponse.success'),
                'message' => 'Details not deleted',
                'data'    => [],
            ], config('constants.invalidResponse.statusCode'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage(),
                'data'    => config('constants.emptyData'),
            ], config('constants.invalidResponse.statusCode'));
        }
    }

    /* touch Us list Show  */
    public function touchUsShow(Request $request)
    {
        $this->validate($request, [
            'touch_us_id' => 'required'
        ]);
        return response([
            'success' => config('constants.validResponse.success'),
            'message' => 'Touch us list',
            'data' => ContactUs::find($request->touch_us_id)
        ], config('constants.validResponse.statusCode'));
    }
}
