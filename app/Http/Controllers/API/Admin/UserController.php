<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use DataTables;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Utils\UserUtil;

class UserController extends Controller {
    protected $userUtil;
    public function __construct(UserUtil $userUtil)
    {
        $this->userUtil = $userUtil;
    }

    public function userDatatable(Request $request) {
        $User =  DB::table('users');
        if(@$request->user_name != "") {
            $User->where('user_name','=',$request->user_name);
        }
        if(@$request->first_name != "") {
            $User->where('first_name','=',$request->first_name);
        }
        if(@$request->last_name != "") {
            $User->where('last_name','=',$request->last_name);
        }
        if(@$request->email != "") {
            $User->where('email','=',$request->email);
        }
        if(@$request->is_active  != "") {
            $User->where('is_active','=',$request->is_active);
        } 
        $userData = $User->select('id', 'first_name', 'last_name','user_name','email','is_active','created_at')
        ->where('id', '!=', 1)
        ->orderBy('id', 'desc')
        ->get();
        return Datatables::of($userData)->make(true);
    }
    public function notificationDatatable(Request $request) {
        $Notification = DB::table('mst_user_notification as mun');
        if(@$request->user_name != "") {
         $Notification->where('users.user_name','=',$request->user_name);
          
        }
        if(@$request->title != "") {
            $Notification->where('mun.title','=',$request->title);
        }
        if(@$request->is_read != "") {
            $Notification->where('mun.is_read','=',$request->is_read);
        }
        $userNotificationData = $Notification->select('mun.is_read', 'users.user_name', 'mun.title','mun.description', 'mun.notification_icon','mun.screen_no','mun.created_by', 'mun.created_at')
            ->leftjoin('users', 'users.id', '=', 'mun.user_id')
            ->orderBy('mun.id', 'desc')
            ->get();
        foreach ($userNotificationData as $kData => $vData) {
            $userNotificationData[$kData]->created_by = get_UserName($vData->created_by);
        }
        return Datatables::of($userNotificationData)->make(true);
    }

    public function notificationCounts(Request $request) {
        $notificationCount['counts'] = DB::table('mst_user_notification')->where('is_read','=','0')->count();
        return response([
            'success' => config('constants.validResponse.success'),
            'message' => 'success',
            'data'    => $notificationCount,
        ], config('constants.validResponse.statusCode'));
    }
    public function notificationList(Request $request) {
        $notificationList= DB::table('mst_user_notification')->orderBy('is_read', 'asc')->orderBy('id', 'desc')->limit(5)->get();
        if($notificationList){
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => 'success',
                'data'    => $notificationList,
            ], config('constants.validResponse.statusCode'));
        }else{
            return response([
                'success' => config('constants.invalidResponse.success'),
                'message' => 'Something went wrong',
                'data'    => $notificationList,
            ], config('constants.invalidResponse.statusCode'));
        }
    }
    public function get_UserDocument(Request $request) {
        $data = $request->validate([
            'user_id' => 'required',
        ]);
        $DocumentList= DB::table('mst_documents')->where('user_id','=',$request->user_id)->orderBy('id', 'desc')->get();
        foreach ($DocumentList as $kData => $vData) {
            $DocumentList[$kData]->file_url = responseMediaLink($vData->file_url, 'User_Document');
        }

        if($DocumentList){
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => 'success',
                'data'    => $DocumentList,
            ], config('constants.validResponse.statusCode'));
        }else{
            return response([
                'success' => config('constants.invalidResponse.success'),
                'message' => 'Something went wrong',
                'data'    => [],
            ], config('constants.invalidResponse.statusCode'));
        }
    }
    public function changePassword(Request $request) {
        $data = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
            'user_id' => 'required',
        ]);
        $usersData= DB::table('users')
                    ->where('is_active','=','1')
                    ->where('id','=',$request->user_id)
                    ->orderBy('id', 'desc')->first();
        if(Hash::check($request->old_password,$usersData->password) ){
            User::find(auth()->user()->id)
            ->update([
                'password' => Hash::make($request->new_password),
            ]);
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => 'Password has been changed',
            ], config('constants.validResponse.statusCode'));

        }else{
            return response([
                'success' => config('constants.invalidResponse.success'),
                'message' => 'Password not matched!',
                'data'    => [],
            ], config('constants.invalidResponse.statusCode'));
        }
    }

    public function userChangeStatus(Request $request) {
        $data = $request->validate([
            'user_id' => 'required',
        ]);
       
        $user = DB::update('update users set is_active=1-is_active where id="' . $request->user_id . '"');
        if ($user) {
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

    /* profile List */
    public function profileList(Request $request)
    {
        return response([
            'success' => config('constants.validResponse.success'),
            'message' => 'Profile List',
            'data' => $this->userUtil->profileAuth($request)
        ], config('constants.validResponse.statusCode'));
    }
}
