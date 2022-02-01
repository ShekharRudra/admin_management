<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParameterValue;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ParameterValueController extends Controller {

    public function parameterValueDatatable(Request $request) {
        $ParameterValue = ParameterValue::query();
        if(@$request->parameter_type_id != "") {
            $ParameterValue->where('mst_parameter_value.parameter_type_id','=',$request->parameter_type_id);
        }
        if(@$request->parameter_value != "") {
            $ParameterValue->where('mst_parameter_value.parameter_value','=',$request->parameter_value);
        }
        if(@$request->is_active  != "") {
            $ParameterValue->where('mst_parameter_value.is_active','=',$request->is_active);
        } 
        $parameterValue = $ParameterValue->select('parameter_type_id', 'mst_parameter_value.id', 'mst_parameter_value.is_active', 'parameter_value_code', 'mst_parameter_value.remark', 'parameter_value_code', 'parameter_value', 'accepted_values', 'image_link', 'sequence_no', 'pt.parameter_type_name as parameter_type')
            ->leftjoin('mst_parameter_type as pt', 'parameter_type_id', '=', 'pt.id')
            ->orderBy('mst_parameter_value.id', 'desc')
            ->get();
        foreach ($parameterValue as $kData => $vData) {
            $parameterValue[$kData]->image_link = responseMediaLink($vData->image_link, 'Parameter_Images');
        }

        return Datatables::of($parameterValue)->make(true);
    }
    public function parameterValueChangeStatus(Request $request) {
        $data = $request->validate([
            'parameter_value_id' => 'required',
        ]);
        $parameterValue = DB::update('update mst_parameter_value set is_active=1-is_active where id="' . $request->parameter_value_id . '"');
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
    public function deleteParameterValue(Request $request) {
        $data = $request->validate([
            'parameter_value_id' => 'required',
        ]);
        $parameterValue = ParameterValue::where('id', '=', $request->parameter_value_id)->delete();
        if ($parameterValue) {
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => 'Category deleted successfully',
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
    public function updateOrCreateParameterValue(Request $request) {
        $data = $request->validate([
            'category_type'    => 'required',
            // 'parameter_value_code' => 'required',
            'category_name'      => 'required',
            'sequence_no'          => 'required',
            // 'accepted_values'      => 'required',
            'remark'               => '',
        ]);
        $Sequence_No_Exist = ParameterValue::where('id', '!=', $request->parameter_value_id)
            ->where('parameter_type_id', '=', $request->category_type)
            ->where('sequence_no', '=', $request->sequence_no)
            ->count();

        if ($Sequence_No_Exist > 0) {
            return response([
                'success' => config('constants.invalidResponse.success'),
                'message' => 'Sequence already in use please choose another one',
                'data'    => [],
            ], config('constants.invalidResponse.statusCode'));

        }

        $parameterValue = ParameterValue::updateOrCreate(
            ['id' => $request->parameter_value_id], [
                'parameter_type_id'    => $request->category_type,
                // 'parameter_value_code' => $request->parameter_value_code,
                'parameter_value'      => $request->category_name,
                'sequence_no'          => $request->sequence_no,
                // 'accepted_values'      => $request->accepted_values,
                'remark'               => $request->remark,
            ]);
        DB::commit();
        if ($parameterValue) {
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => (@$request->parameter_value_id == '') ? "Category added successfully" : "Category updated successfully",
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
