<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use DataTables;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Plan;
use App\Models\PlanFeatures;

class PlanController extends Controller {
    public function planDatatable(Request $request) {
        $Plan = DB::table('mst_plan');
        if(@$request->plan_type != "") {
            $Plan->where('plan_type','=',$request->plan_type);
        }
        if(@$request->plan_name != "") {
            $Plan->where('plan_name','=',$request->plan_name);
        }
        if(@$request->title != "") {
            $Plan->where('title','like',$request->title);
        }
        if(@$request->month != "") {
            $Plan->where('month','=',$request->month);
        }
        if(@$request->amount != "") {
            $Plan->where('amount','=',$request->amount);
        }
        if(@$request->is_active  != "") {
            $Plan->where('is_active','=',$request->is_active);
        } 
        $planData = $Plan->select('id', 'plan_name', 'title', 'description','month','amount','created_at','plan_type','is_active')
            ->orderBy('id', 'desc')
            ->get();

        return Datatables::of($planData)->make(true);
    }
    public function updateOrCreatePlan(Request $request) {
        $data = $request->validate([
            'plan_type'    => 'required',
            'plan_name' => 'required',
            'title'      => 'required',
            'month'          => 'required',
            'amount'      => 'required',
            'description'               => '',
        ]);
        $plan_name_Exist = Plan::where('id', '!=', $request->plan_id)
            ->where('plan_name', '=', $request->plan_name)
            ->count();

        if ($plan_name_Exist > 0) {
            return response([
                'success' => config('constants.invalidResponse.success'),
                'message' => 'Plan name already in use please choose another one',
                'data'    => [],
            ], config('constants.invalidResponse.statusCode'));

        }
        $plan = Plan::updateOrCreate(
            ['id' => $request->plan_id], [
                'plan_type'    => $request->plan_type,
                'plan_name' => $request->plan_name,
                'title'      => $request->title,
                'month'          => $request->month,
                'amount'      => $request->amount,
                'description'               => $request->description,
            ]);
        DB::commit();
        if ($plan) {
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => (@$request->plan_id == '') ? "Plan added successfully" : "Plan updated successfully",
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
    public function planChangeStatus(Request $request) {
        $data = $request->validate([
            'plan_id' => 'required',
        ]);
        $plan = DB::update('update mst_plan set is_active=1-is_active where id="' . $request->plan_id . '"');
        if ($plan) {
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
    public function deletePlan(Request $request) {
        $data = $request->validate([
            'plan_id' => 'required',
        ]);
        $plans = Plan::where('id', '=', $request->plan_id)->delete();
        if ($plans) {
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => 'Plan deleted successfully',
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
    public function getPlan(Request $request) {
        $featuresList= DB::table('mst_plan')->orderBy('id', 'desc')->get();
        return response([
            'success' => config('constants.validResponse.success'),
            'message' => 'Data get successfully',
            'data'    => $featuresList,
        ], config('constants.validResponse.statusCode'));

    }

    public function getPlanFeatures(Request $request) {
        $featuresList= DB::table('mst_plan_features')->orderBy('sequence_no', 'asc')->get();
        return response([
            'success' => config('constants.validResponse.success'),
            'message' => 'Data get successfully',
            'data'    => $featuresList,
        ], config('constants.validResponse.statusCode'));

    }
    public function deletePlanFeatures(Request $request) {
        $data = $request->validate([
            'features_id' => 'required',
        ]);
        $planFeatures = PlanFeatures::where('id', '=', $request->features_id)->delete();
        if ($planFeatures) {
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => 'Features deleted successfully',
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


    public function savePlanFeatures(Request $request) {
        $data = $request->validate([
            'FeatureArray'    => 'required',
        ]);
        $FeatureArray = json_decode($request->FeatureArray, true);

        foreach ($FeatureArray as $key1 => $val1) {
            
            if($val1['features']==""){
                return response([
                    'success' => config('constants.invalidResponse.success'),
                    'message' => 'The features field is required.',
                    'data'    => [],
                ], config('constants.invalidResponse.statusCode'));
            }
            $AddFeature = PlanFeatures::updateOrCreate(
                ['id' => $val1['id']], [
                    'features'    => $val1['features'],
                    'sequence_no' => $key1,
                ]);
                DB::commit();
        }

        // foreach ($FeatureArray as $key => $val) {
            
        // }
        
        if ($AddFeature) {
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => "Features saved successfully",
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
    public function addPermission(Request $request) {
        $data = $request->validate([
            'comman'    => 'required',
            'data'    => 'required',
            'plan_id'    => 'required',
        ]);
        parse_str($request->data);
        $chkAccessibleArr = array();
        if ($chkAccessible != "") {
            $chkAccessibleArr = explode(',', $chkAccessible);
        }
        sort($chkAccessibleArr);
        $update_data = DB::update('update mst_plan_features_permission SET is_accessible=0 WHERE plan_id="' . $request->plan_id . '"');
        
        $features = $request->comman;
        $featuresID = array_unique(explode(',', $features));
        foreach ($featuresID as $kfeaturesID => $vfeaturesID) {
            $select_data= DB::table('mst_plan_features_permission')
                    ->where('plan_id','=',$request->plan_id)
                    ->where('plan_features_id','=',$vfeaturesID)
                    ->get();
            if (count($select_data) == 0) {
                $inserQuery = " Insert INTO `mst_plan_features_permission`";
                $fieldQuery = " (`plan_id`, `plan_features_id` ";
                $valueQuery = " values ('" . $request->plan_id . "','" . $vfeaturesID . "' ";
                if (in_array($vfeaturesID, $chkAccessibleArr)) {
                    $fieldQuery .= " ,`is_accessible` ";
                    $valueQuery .= " ,1 ";
                }
                $fieldQuery .= " ,`created_at`) ";
                $valueQuery .= " ,'" . date('Y-m-d H:i:s') . "') ";
                $insert_data = $inserQuery . $fieldQuery . $valueQuery;
                DB::insert($insert_data);
            } else {
                $upQuery = " UPDATE `mst_plan_features_permission` SET plan_id = '" . $request->plan_id . "'";
                $fieldQuery = "";
                $whQuery = " where  plan_id = '" . $request->plan_id . "' and plan_features_id = '" . $vfeaturesID . "' ";
                if (in_array($vfeaturesID, $chkAccessibleArr)) {
                    $fieldQuery .= " ,is_accessible = 1 ";
                }
                $fieldQuery .= " , updated_at = '" . date('Y-m-d H:i:s') . "' ";
                $update_data = $upQuery . $fieldQuery . $whQuery;
                DB::update($update_data);
            }
        }
        return response([
            'success' => config('constants.validResponse.success'),
            'message' => "Permission given successfully",
            'data'    => [],
        ], config('constants.validResponse.statusCode'));


    }
    public function getPermission(Request $request) {
        $data = $request->validate([
            'plan_id'    => 'required',
        ]);
        $featuresList= PlanFeatures::orderBy('sequence_no', 'asc')->get();
        $html = '';
        $html .= '<table id="tbl-permission" class="table table-stripped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Features</th>
                                <th>Is Accessible</th>
                            </tr>
                        </thead>
                        <tbody class="cls-features">';
                        foreach ($featuresList as $key1 => $val1) {
                            $permission= DB::table('mst_plan_features_permission')
                            ->where('plan_id','=',$request->plan_id)
                            ->where('plan_features_id','=',$val1['id'])
                            ->get();
                            $checked_Accessible = '';
                            if (isset($permission[0])) {
                                $checked_Accessible = $permission[0]->is_accessible == '1' ? 'checked' : '';
                            }
                            $i = $key1 + 1;
                            $html .= '<tr class="tr_clone">
                                <td>' . $i . '</td>
                                <td>' . $val1['features'] . '</td>
                                <td width="10">
                                <input type="checkbox" class="chkAccessible" id="chkAccessible" name="chkAccessible[]" data-value="' . $val1['id'] . '"  value="' . $val1['id'] . '-is_accessible" ' . $checked_Accessible . '></center></td>
                                </td>
                            </tr>';
                        }
            $html .= '</tbody>
                </table>';

        return response([
            'success' => config('constants.validResponse.success'),
            'message' => 'Data get successfully',
            'data'    => $html,
        ], config('constants.validResponse.statusCode'));
    }


}
