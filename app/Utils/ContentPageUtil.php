<?php

namespace App\Utils;
use Illuminate\Http\Request;
use App\Models\ContentTag;
use App\Models\ContentPage;
use App\Models\Content;
use App\Models\User;
use DataTables;
use Session;
use Str;
use DB;
use File;

Class ContentPageUtil
{
    /* variable get*/
    public function getDetails($request)
    {
        $pages = ContentPage::query();
        if(@$request->search != "") {
            $pages->where('page_name','like', '%'.$request->search.'%');
        }
        if(@$request->page_name != "") {
            $pages->where('page_name','like', '%'.$request->page_name.'%');
        }
        if(@$request->is_active  != "") {
            $pages->where('is_active','=',$request->is_active);
        } 
        return $pages = $pages;
    }
    /* page names list  */
    public function index($request)
    {
        $pages = self::getDetails($request);
        $pages->where('is_active', true);
        $pages->orderBy('page_name', 'asc');
        return $pages = $pages->get();
    }

    /* pages list show datatables */
    public function pageDatatable(Request $request) {
        $pages = self::getDetails($request);
        $pages->orderBy('created_at', 'desc');
        $pages = $pages->get();
        return Datatables::of($pages)->make(true);
    }

    /* page store */
    public function store($request)
    {
        return self::createAndUpdatePage($request);
    }

    /* page update*/
    public function update($request, $id)
    {
        return self::createAndUpdatePage($request, $id);
    }

    //unique createAndUpdatePage
    public function createAndUpdatePage($request, $id = NULL)
    {
        DB::beginTransaction();
        try
        {   
            $page = ContentPage::updateOrCreate(
                ['id' => $id],[
                'page_name' => $request->page_name
            ]);
            if ($page) {
                DB::commit();
                return successResponse('Page details save done!', $page);
            } else {
                return invalidResponse('Failed to Page details save! Try again.');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $bug = $th->getMessage();
            return invalidResponse($th->getMessage());
        }
    }

    /* Content Page delete */
    public function delete($request)
    {
        DB::beginTransaction();
        try
        {   
            $data = ContentPage::where('id', $request->page_id)->delete();
            if ($data) {
                DB::commit();
                return successResponse('Page details successfully removed!', NULL);
            } else {
                return invalidResponse('Failed to remove page details!. Try again.');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $bug = $th->getMessage();
            return invalidResponse($th->getMessage());
        }
    }

    /* Content Page status change */
    public function status($request)
    {
        \Log::info($request->all());
        DB::beginTransaction();
        try
        {   
            $data = ContentPage::where('id', $request->page_id)->update(['is_active' => $request->status]);
            if ($data) {
                $data = ContentPage::where('id', $request->page_id)->first();
                DB::commit();
                return successResponse('Page Status Updated!', $data);
            } else {
                return invalidResponse('Failed to page status update!. Try again.');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $bug = $th->getMessage();
            return invalidResponse($th->getMessage());
        }
    }
}