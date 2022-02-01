<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParameterType;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ParameterTypeController extends Controller {
    public function parameterTypeDatatable(Request $request) {
        $ParameterType = ParameterType::query();
        if(@$request->parameter_type_name != "") {
            $ParameterType->where('parameter_type_name','=',$request->parameter_type_name);
        }
        if(@$request->is_active  != "") {
            $ParameterType->where('is_active','=',$request->is_active);
        } 
        $parameter_type = $ParameterType->select('id', 'is_active', 'parameter_type_name', 'remark')
            ->orderBy('id', 'desc')
            ->get();
        return Datatables::of($parameter_type)->make(true);
    }
    public function getParameterType(Request $request) {
        return response([
            'success' => config('constants.validResponse.success'),
            'message' => 'Data get successfully',
            'data'    => get_ParameterType(),
        ], config('constants.validResponse.statusCode'));

    }
    public function parameterTypeChangeStatus(Request $request) {
        $data = $request->validate([
            'parameter_type_id' => 'required',
        ]);
        $parameterType = DB::update('update mst_parameter_type set is_active=1-is_active where id="' . $request->parameter_type_id . '"');
        if ($parameterType) {
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
    public function deleteParameterType(Request $request) {
        $data = $request->validate([
            'parameter_type_id' => 'required',
        ]);
        $parameterType = ParameterType::where('id', '=', $request->parameter_type_id)->delete();
        if ($parameterType) {
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => 'Category type deleted successfully',
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

    public function updateOrCreateParameterType(Request $request) {
        $data = $request->validate([
            'category_type_name' => 'required',
        ]);

        $Check_Exits = ParameterType::where('parameter_type_name', '=', $request->category_type_name)->count();

        if ($request->parameter_type_id != '' && $request->category_type_name != '') {
            $Check_Exits = ParameterType::where('id', '!=', $request->parameter_type_id)->where('parameter_type_name', '=', $request->category_type_name)->count();
        }
        if ($Check_Exits == 0) {
            $parameterType = ParameterType::updateOrCreate(
                ['id' => $request->parameter_type_id], [
                    'parameter_type_name' => $request->category_type_name,
                    'remark'              => $request->remark,
                ]);
            DB::commit();
            if ($parameterType) {
                return response([
                    'success' => config('constants.validResponse.success'),
                    'message' => (@$request->parameter_type_id == '') ? "Category type added successfully" : "Category type updated successfully",
                    'data'    => [],
                ], config('constants.validResponse.statusCode'));

            } else {
                return response([
                    'success' => config('constants.invalidResponse.success'),
                    'message' => 'Something went wrong',
                    'data'    => [],
                ], config('constants.invalidResponse.statusCode'));

            }
        } else {
            return response([
                'success' => config('constants.invalidResponse.success'),
                'message' => 'This Category type name is already exits',
                'data'    => [],
            ], config('constants.invalidResponse.statusCode'));
        }

    }
}
