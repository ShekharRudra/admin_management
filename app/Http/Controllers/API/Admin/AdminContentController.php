<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentTag;
use App\Models\ContentPage;
use App\Models\Content;
use App\Utils\UserUtil;
use App\Utils\ContentPageUtil;
use App\Utils\ContentTagUtil;
use App\Utils\ContentUtil;
use Illuminate\Contracts\Validation\Rule;

class AdminContentController extends Controller
{
    protected $userUtil;
    protected $pageUtil;
    protected $tagUtil;
    protected $contentUtil; 
    public function __construct(UserUtil $userUtil, ContentPageUtil $pageUtil, ContentTagUtil $tagUtil, ContentUtil $contentUtil)
    {
        $this->middleware('auth');
        $this->userUtil = $userUtil;
        $this->pageUtil = $pageUtil;
        $this->tagUtil = $tagUtil;
        $this->contentUtil = $contentUtil;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $response = [
            'types' => typeList(),
            'sides' =>  sideList(),
            'tags' => $this->tagUtil->index($request),
            'page_names' => $this->pageUtil->index($request)
        ];
        return successResponse('Content Form Use Details', $response);
    }

    /*  
        * Contant Tag List
        * Contant Tag Datatable List
        * Contant Tag store
        * Contant Tag update
        * Contant Tag delete
        * Contant Tag show
        * Contant Tag check already exist
    */
    
    /* content Tag List */
    public function contentTagList(Request $request)
    {
        $response = $this->tagUtil->index($request);
        return successResponse('Tags List', $response);
    }

    /* content Tag Datatable List */
    public function tagDatatable(Request $request)
    {
        $response = $this->tagUtil->tagDatatable($request);
        return successResponse('Tags Datatable List', $response);
    }

    /* content Tag Store */
    public function contentTagStore(Request $request)
    {
        $this->validate($request, [
            'tag_name' => 'required|unique:pg_content_tags'
        ]);
        return $response = $this->tagUtil->store($request);
    }

    /*  content Tag Update **/
    public function contentTagUpdate(Request $request)
    {
        $id = $request->tag_id ?? null;
        $this->validate($request, [
            'tag_name' => 'required | unique:pg_content_tags,tag_name,' . $id,
            'tag_id' => 'required'
        ]);
        return $response = $this->tagUtil->update($request, $id);
    }

    /*  Content Tag Delete */
    public function contentTagDelete(Request $request)
    {
        $this->validate($request, [
            'tag_id' => 'required'
        ]);
        return $response = $this->tagUtil->delete($request);
    } 
    /*  Content  Tag Status Change */
    public function contentTagStatusChange(Request $request)
    {
        $this->validate($request, [
            'tag_id' => 'required',
            'status' => 'required'
        ]);
        return $response = $this->tagUtil->status($request);
    }

    /*  
        * Contant Page List
        * Contant Page Datatable List
        * Contant Page store
        * Contant Page update
        * Contant Page delete
        * Contant Page show
        * Contant Page check already exist
    */

    /* Content Page List **/
    public function contentPageList(Request $request)
    {
        $response = $this->pageUtil->index($request);
        return successResponse('Pages List', $response);
    }

    /* content Page Datatable List ---------------------------------------*/
    public function pageDatatable(Request $request)
    {
        $response = $this->pageUtil->pageDatatable($request);
        return successResponse('Pages Datatable List', $response);
    }

    /* Content Page Store -------------------------------*/
    public function contentPageStore(Request $request)
    {
        $this->validate($request, [
            'page_name' => 'required|unique:pg_content_pages'
        ]);
        return $response = $this->pageUtil->store($request);
    }

    /*  Content Page Update -----------------------------*/
    public function contentPageUpdate(Request $request)
    {
        $id = $request->page_id ?? null;
        $this->validate($request, [
            'page_name' => 'required | unique:pg_content_pages,page_name,' . $id,
            'page_id' => 'required'
        ]);
        return $response = $this->pageUtil->update($request, $id);
    }

    /*  Content Page Delete */
    public function contentPageDelete(Request $request)
    {
        $this->validate($request, [
            'page_id' => 'required'
        ]);
        return $response = $this->pageUtil->delete($request);
    }

    /*  Content Page Status Change */
    public function contentPageStatusChange(Request $request)
    {
        $this->validate($request, [
            'page_id' => 'required',
            'status' => 'required'
        ]);
        return $response = $this->pageUtil->status($request);
    }

    /*  
        * Contant List
        * Contant Datatable List
        * Contant store
        * Contant update
        * Contant delete
        * Contant show
        * Contant check already exist
    */

    /* Content Datatable List 
    --------------------------------------------
    */
    public function contentsList(Request $request)
    {
        $response = $this->contentUtil->index($request);
        foreach ($response as $key => $f) {
            $f->image = responseMediaLink($f->image, 'Content');
        }
        return successResponse('Contents List', $response);
    }

    /* content Datatable List */
    public function contentsDatatable(Request $request)
    {
        $response = $this->contentUtil->contentsDatatable($request);
        return successResponse('Contents Datatable List', $response);
    }

    /* content validation existing */
    public function existContentValidation($request)
    {
        if($request->content_id)
        {
            $contentData =  Content::find($request->content_id);
            if($contentData)
            {   
                $id = $request->content_id;
            }else{
                return invalidResponse('Failed to Content details save! Try again.');
            }
        }else{
            $id = NULL;
        }
        $matchThese = [
            'tag_name' => $request->tag_name, 
            'page_name' => $request->page_name,
            'side' => $request->side
        ];
        $content = Content::query();
        $content->where('tag_name', $request->tag_name);
        $content->where('page_name', $request->page_name);
        $content->where('side', $request->side);
        $content->where('sequence_no', $request->sequence_no);
        if($id)
        {
            $content->whereNotIn('id', [$id]);
        }
        $content = $content->first();
        if($content)
        {
            if($content->side == $request->side && $content->sequence_no == $request->sequence_no)
            {
                return validationError('sequence_no', 'The sequence number has already been taken.');
            }
        }
    }

    /* Content Store ---------------------------------------------------------------------------------*/
    public function contentStore(Request $request)
    {
        $id = $request->content_id ?? null;
        $dataNull = self::existContentValidation($request);
        if(!$dataNull)
        {
            if($request->type == 'image')
            {   
                $data = [
                    'tag_name' => 'required',
                    'page_name' => 'required',
                    'sequence_no' => 'required',
                    'side' => 'required',
                    'type' => 'required',
                    'image' => 'required'
                ];
            }elseif($request->type == 'description'){
                $data = [
                    'tag_name' => 'required',
                    'page_name' => 'required',
                    'sequence_no' => 'required',
                    'side' => 'required',
                    'type' => 'required',
                    'description' => 'required'
                ];
            }else{
                $data = [
                    'tag_name' => 'required',
                    'page_name' => 'required',
                    'sequence_no' => 'required|unique:pg_contents,sequence_no',
                    'side' => 'required',
                    'type' => 'required',
                    'description' => 'required'
                ];
            }
            $this->validate($request, $data);
            return $response = $this->contentUtil->store($request);
        }
        return $dataNull;
    }

    /*  Content Update -------------------------------------------------------------------------------*/
    public function contentUpdate(Request $request)
    {
        $id = $request->content_id ?? null;
        $dataNull = self::existContentValidation($request);
        if(!$dataNull)
        {
            if($request->type == 'image')
            {   
                $data = [
                    'tag_name' => 'required',
                    'page_name' => 'required',
                    'sequence_no' => 'required',
                    'side' => 'required',
                    'type' => 'required',
                    'image' => 'required',
                    'content_id' => 'required'
                ];
            }elseif($request->type == 'description'){
                $data = [
                    'tag_name' => 'required',
                    'page_name' => 'required',
                    'sequence_no' => 'required',
                    'side' => 'required',
                    'type' => 'required',
                    'description' => 'required',
                    'content_id' => 'required'
                ];
            }else{
                $data = [
                    'tag_name' => 'required',
                    'page_name' => 'required',
                    'sequence_no' => 'required',
                    'side' => 'required',
                    'type' => 'required',
                    'description' => 'required',
                    'content_id' => 'required'
                ];
            }

            $this->validate($request, $data);
            return $response = $this->contentUtil->update($request, $id);
        }
        return $dataNull;
    }

    /*  Content Delete */
    public function contentDelete(Request $request)
    {
        $this->validate($request, [
            'content_id' => 'required'
        ]);
        return $response = $this->contentUtil->delete($request);
    } 
    /*  Content Status Change */
    public function contentStatusChange(Request $request)
    {
        $this->validate($request, [
            'content_id' => 'required',
            'status' => 'required'
        ]);
        return $response = $this->contentUtil->status($request);
    } 
}