<?php

namespace App\Http\Controllers\API\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Learn;
use App\Models\LearnLibrary;
use DataTables;
use DB;
use Illuminate\Support\Facades\Http;
use App\Utils\LearnUtil;


class UserLearnController extends Controller
{
    protected $learnUtil;
    public function __construct(LearnUtil $learnUtil)
    {
        $this->learnUtil = $learnUtil;
    }

    public function getUserLearnVideo(Request $request) {
        $learnVideos = $this->learnUtil->index($request);
        $response = $this->learnUtil->learnVideosList($request, $learnVideos);
        return response([
            'success' => config('constants.validResponse.success'),
            'message' => 'Learning Videos',
            'data'    => $response,
        ], config('constants.validResponse.statusCode'));
    }
}
