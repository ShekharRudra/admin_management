<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\ParameterValue;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SubCategoryController extends Controller {

    public function subCategoryDatatable(Request $request) {
        $SubCategory = SubCategory::query();
        if(@$request->category_id != "") {
            $SubCategory->where('mst_sub_category.category_id','=',$request->category_id);
        }
        if(@$request->sub_category != "") {
            $SubCategory->where('mst_sub_category.sub_category','=',$request->sub_category);
        }
        if(@$request->is_active  != "") {
            $SubCategory->where('mst_sub_category.is_active','=',$request->is_active);
        } 
        $subCategory = $SubCategory->select('mst_sub_category.id', 'mst_sub_category.is_active', 'mst_sub_category.sub_category','pv.id as category_id', 'pv.parameter_value as category')
            ->leftjoin('mst_parameter_value as pv', 'category_id', '=', 'pv.id')
            ->orderBy('mst_sub_category.id', 'desc')
            ->get();
        return Datatables::of($subCategory)->make(true);
    }
    public function getCategory(Request $request) {
        $get_Category = ParameterValue::where('parameter_type_id', '=', '1')
        ->where('is_active', '=', '1')
        ->get();
        return response([
            'success' => config('constants.validResponse.success'),
            'message' => 'Data get successfully',
            'data'    => $get_Category,
        ], config('constants.validResponse.statusCode'));

    }
    public function subCategoryChangeStatus(Request $request) {
        $data = $request->validate([
            'sub_category_id' => 'required',
        ]);
        $subCategory = DB::update('update mst_sub_category set is_active=1-is_active where id="' . $request->sub_category_id . '"');
        if ($subCategory) {
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
    public function deleteSubCategory(Request $request) {
        $data = $request->validate([
            'sub_category_id' => 'required',
        ]);
        $subCategory = SubCategory::where('id', '=', $request->sub_category_id)->delete();
        if ($subCategory) {
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => 'Sub category deleted successfully',
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
    public function updateOrCreateSubCategory(Request $request) {
        $data = $request->validate([
            'category'    => 'required',
            'sub_category' => 'required',
        ]);
        $Sequence_No_Exist = SubCategory::where('id', '!=', $request->sub_category_id)
            ->where('category_id', '=', $request->category)
            ->where('sub_category', '=', $request->sub_category)
            ->count();

        if ($Sequence_No_Exist > 0) {
            return response([
                'success' => config('constants.invalidResponse.success'),
                'message' => 'Sub category already exist',
                'data'    => [],
            ], config('constants.invalidResponse.statusCode'));

        }

        $subCategory = SubCategory::updateOrCreate(
            ['id' => $request->sub_category_id], [
                'category_id'    => $request->category,
                'sub_category' => $request->sub_category,
            ]);
        DB::commit();
        if ($subCategory) {
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => (@$request->sub_category_id == '') ? "Sub category added successfully" : "Sub category updated successfully",
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
