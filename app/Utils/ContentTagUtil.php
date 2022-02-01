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

Class ContentTagUtil
{
    /* variable get*/
    public function getDetails($request)
    {
        $contentTag =  ContentTag::query();
        if(@$request->search)
        {
            $contentTag->where('tag_name', 'like', '%'.$request->search.'%');
        }
        if(@$request->tag_name)
        {
            $contentTag->where('tag_name', 'like', '%'.$request->tag_name.'%');
        }
        if(@$request->is_active  != "") {
            $contentTag->where('is_active','=',$request->is_active);
        }
        return $contentTag = $contentTag;
    }

    /* tag list show */
    public function index($request)
    { 
        $tags = self::getDetails($request);
        $tags->where('is_active', true);
        $tags->orderBy('tag_name', 'asc');
        return $tags = $tags->get();
    }

    /* tags list show datatables */
    public function tagDatatable(Request $request) {
        $tags = self::getDetails($request);
        $tags->orderBy('created_at', 'desc');
        $tags = $tags->get();
        return Datatables::of($tags)->make(true);
    }

    /* Tag store */
    public function store($request)
    {
        return self::createAndUpdateTag($request);
    }

    /* Tag update*/
    public function update($request, $id)
    {
        return self::createAndUpdateTag($request, $id);
    }

    //unique createAndUpdateTag
    public function createAndUpdateTag($request, $id = NULL)
    {
        DB::beginTransaction();
        try
        {   
            $tag = ContentTag::updateOrCreate(
                ['id' => $id],[
                'tag_name' => $request->tag_name
            ]);
            if ($tag) {
                DB::commit();
                return successResponse('Tag details save done!', $tag);
            } else {
                return invalidResponse('Failed to Tag details save! Try again.');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $bug = $th->getMessage();
            return invalidResponse($th->getMessage());
        }
    }

    /* Content Tag delete */
    public function delete($request)
    {
        DB::beginTransaction();
        try
        {   
            $data = ContentTag::where('id', $request->tag_id)->delete();
            if ($data) {
                DB::commit();
                return successResponse('Tag details successfully removed!', NULL);
            } else {
                return invalidResponse('Failed to remove tag details!. Try again.');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $bug = $th->getMessage();
            return invalidResponse($th->getMessage());
        }
    }

    /* Content Tag status change */
    public function status($request)
    {
        \Log::info($request->all());
        DB::beginTransaction();
        try
        {   
            $data = ContentTag::where('id', $request->tag_id)->update(['is_active' => $request->status]);
            if ($data) {
                $data = ContentTag::where('id', $request->tag_id)->first();
                DB::commit();
                return successResponse('Tag Status Updated!', $data);
            } else {
                return invalidResponse('Failed to tag status update!. Try again.');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $bug = $th->getMessage();
            return invalidResponse($th->getMessage());
        }
    }
}