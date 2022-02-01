<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use DataTables;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Revenue;

class RevenueController extends Controller {
    public function revenueDatatable(Request $request) {
        $Revenue = DB::table('trn_revenue');
        if(@$request->plan_id != "") {
            $Revenue->where('trn_revenue.plan_id','=',$request->plan_id);
        }
        if(@$request->user_name != "") {
            $Revenue->where('ur.user_name','=',$request->user_name);
        }
        if(@$request->email != "") {
            $Revenue->where('ur.email','=',$request->email);
        }
        if(@$request->transaction_number != "") {
            $Revenue->where('trn_revenue.transaction_number','=',$request->transaction_number);
        }
        if(@$request->amount  != "") {
            $Revenue->where('trn_revenue.amount','=',$request->amount);
        } 
        if(@$request->status  != "") {
            $Revenue->where('trn_revenue.status','=',$request->status);
        } 
        $revenueData = $Revenue->select('trn_revenue.id', 'trn_revenue.status', 'ur.user_name', 'ur.email','trn_revenue.transaction_number','mp.plan_name','trn_revenue.amount','trn_revenue.start_date','trn_revenue.end_date','trn_revenue.created_at')
        ->leftjoin('users as ur', 'trn_revenue.user_id', '=', 'ur.id')
        ->leftjoin('mst_plan as mp', 'trn_revenue.plan_id', '=', 'mp.id')
        ->orderBy('trn_revenue.id', 'desc')
        ->get();
        return Datatables::of($revenueData)->make(true);
    }

    public function revenueChangeStatus(Request $request) {
        $data = $request->validate([
            'user_id' => 'required',
        ]);
       
        $revenue = DB::update('update users set is_active=1-is_active where id="' . $request->user_id . '"');
        if ($revenue) {
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

}
