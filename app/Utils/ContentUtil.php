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

Class ContentUtil
{
    /* variable get*/
    public function getDetails($request)
    {
        $contents =  Content::query();
        if($request->search)
        {
            $contents->where('tag_name', 'like', '%'.$request->search.'%');
        }
        if($request->tag_name)
        {
            $contents->where('tag_name', 'like', '%'.$request->tag_name.'%');
        }
        if($request->page_name)
        {
            $contents->where('page_name', 'like', '%'.$request->page_name.'%');
        }
        if(@$request->is_active  != "") {
            $contents->where('is_active','=',$request->is_active);
        }
        $contents->orderBy('sequence_no', 'asc');
        return $contents = $contents;
    } 
    /* Content list show */
    public function index($request)
    {   
        $contents = self::getDetails($request);
        $contents->where('is_active', true);
        return $contents->get();
    }

    /* tags list show datatables */
    public function contentsDatatable(Request $request) {
        $contents = self::getDetails($request);
        $contents = $contents->get();
        foreach ($contents as $key => $f) {
            $f->image = responseMediaLink($f->image, 'Content');
        }
        return Datatables::of($contents)->make(true);
    }

    /* Content store */
    public function store($request)
    {
        return self::createAndUpdateContent($request);
    }

    /* Content update*/
    public function update($request, $id)
    {
        return self::createAndUpdateContent($request, $id);
    }

    //unique createAndUpdateContent
    public function createAndUpdateContent($request, $id = NULL)
    {
        DB::beginTransaction();
        try
        {   

            if($content = Content::find($id))
            {
                $file = $content->image;
                $old_image = image_public_path().$content->image;
                
            }else{
                $file = null;
                $old_image = null;
            }

            if ($request->hasFile('image')) {
                $file = uploadFile($request->file('image'), 'Content');
                if($old_image && $content->image)
                {
                    removeFile($content->image, 'Content');
                }
            }else{
                if($request->type == 'description' && $id && $old_image && $content->image){
                    removeFile($content->image, 'Content');
                }
            }

            $page = Content::updateOrCreate(
                ['id' => $id],[
                'tag_name' => $request->tag_name,
                'page_name' => $request->page_name,
                'sequence_no' => $request->sequence_no,
                'side' => $request->side,
                'type' => $request->type,
                'image' => $file,
                'description' => $request->description
            ]);
            if ($page) {
                DB::commit();
                return successResponse('Content details save done!', $page);
            } else {
                return invalidResponse('Failed to Content details save! Try again.');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $bug = $th->getMessage();
            return invalidResponse($th->getMessage());
        }
    }

    /* Content delete */
    public function delete($request)
    {
        DB::beginTransaction();
        try
        {   
            $data = Content::where('id', $request->content_id)->delete();
            if ($data) {
                DB::commit();
                return successResponse('Content details successfully removed!', $data);
            } else {
                return invalidResponse('Failed to remove Content details!. Try again.');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $bug = $th->getMessage();
            return invalidResponse($th->getMessage());
        }
    }

    /* Content status change */
    public function status($request)
    {
        \Log::info($request->all());
        DB::beginTransaction();
        try
        {   
            $data = Content::where('id', $request->content_id)->update(['is_active' => $request->status]);
            if ($data) {
                DB::commit();
                $data = Content::where('id', $request->content_id)->first();
                return successResponse('Content status updated!', $data);
            } else {
                return invalidResponse('Failed to content status update!. Try again.');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $bug = $th->getMessage();
            return invalidResponse($th->getMessage());
        }
    }
}