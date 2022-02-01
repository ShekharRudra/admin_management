<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller {
    public function getDashboard(Request $request) {

        // $userArray = array();

        // $userArray['Total_Users'] =
        // $userArray['Total_Users'] =
        // $userArray['Total_Users'] =

        // $response['Summary_Users'] = User::select(DB::raw('(SELECT COUNT(id) from users where id!=1) as Total_Users'), DB::raw('(SELECT COUNT(id) from users where is_verified=0 and id!=1) as Total_Pending'), DB::raw('(SELECT COUNT(id) from users where is_verified=1 and id!=1) as Total_Verified'))->first();

        // $response['Summary_Art'] = User::select(DB::raw('(SELECT COUNT(id) from mst_art) as Total_Arts'), DB::raw('(SELECT COUNT(id) from mst_art where is_active=0 ) as Total_Inactive'), DB::raw('(SELECT COUNT(id) from mst_art where is_active=1 ) as Total_Active'))->first();

        // $response['Recent_Users'] = User::select(DB::raw('(SELECT COUNT(id) from mst_art) as Total_Arts'), DB::raw('(SELECT COUNT(id) from mst_art where is_active=0 ) as Total_Inactive'), DB::raw('(SELECT COUNT(id) from mst_art where is_active=1 ) as Total_Active'))->first();\

        // $response['Recent_arts'] = User::select(DB::raw('(SELECT COUNT(id) from mst_art) as Total_Arts'), DB::raw('(SELECT COUNT(id) from mst_art where is_active=0 ) as Total_Inactive'), DB::raw('(SELECT COUNT(id) from mst_art where is_active=1 ) as Total_Active'))->first();


        // return response([
        //     'success' => true,
        //     'message' => 'success',
        //     'data'    => $response,
        // ], config('constants.validResponse.statusCode'));

    }
}
