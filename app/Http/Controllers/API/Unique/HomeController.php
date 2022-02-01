<?php

namespace App\Http\Controllers\API\Unique;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\UserUtil;
use App\Utils\ContentPageUtil;
use App\Utils\ContentTagUtil;
use App\Utils\ContentUtil;

class HomeController extends Controller
{
    protected $userUtil;
    protected $pageUtil;
    protected $tagUtil;
    protected $contentUtil;
    public function __construct(UserUtil $userUtil, ContentPageUtil $pageUtil, ContentTagUtil $tagUtil, ContentUtil $contentUtil)
    {
        $this->userUtil = $userUtil;
        $this->pageUtil = $pageUtil;
        $this->tagUtil = $tagUtil;
        $this->contentUtil = $contentUtil;
    }

    public function __invoke(Request $request)
    {
        $response = [
            'types' => typeList(),
            'sides' =>  sideList(),
            'tags' => $this->tagUtil->index($request)->makeHidden(['created_at','updated_at' ]),
            'page_names' => $this->pageUtil->index($request)
        ];
        return successResponse('Content Form Use Details', $response);
    }

    /* type List */
    public function typeList(Request $request)
    {
        $response =  typeList();
        return successResponse('Type List', $response);
    }

    /* side List */
    public function sideList(Request $request)
    {
        $response =  sideList();
        return successResponse('Side List', $response);
    }

    public function contentsList(Request $request)
    {
        $response = $this->contentUtil->index($request);
        foreach ($response as $key => $f) {
            $f->image = responseMediaLink($f->image, 'Content');
        }
        return successResponse('Contents List', $response);
    }
}
