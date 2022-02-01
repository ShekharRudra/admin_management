<?php
use App\Models\ParameterType;
use App\Models\User;
use App\Models\ParameterValue;
use App\Models\Trn_Income;
use App\Models\Trn_Expense_Sub;


function project($name) {
    if ($name == 'app_name') {
        return config('app.name');
    }

    if ($name == 'app_favicon_path') {
        return asset('/assets/admin/images/logo/favicon.ico');
    }
    if ($name == 'app_logo_path') {
        return asset('/assets/admin/images/logo/logo.png');
    }
}


// Upload files
function uploadFile($file, $dir, $filecount = null,$NewFileName=null) {
    if($NewFileName!=null){
        $fileName =$NewFileName;
    }else{
        $ext = $file->getClientOriginalExtension();
        if ($ext != '') {
            $fileName = time() . $filecount . '.' . $ext;
        } else {
            $ext      = $file->extension();
            $fileName = time() . $filecount . '.' . $ext;
        }
    }
    Storage::disk('public')->putFileAs($dir, $file, $fileName);
    return $fileName;
}

// Response media file
function responseMediaLink($file, $dirfolder) {
    // $fileResponseLink = asset('storage/common/default.png');
    $fileResponseLink = '';

    if ($dirfolder == 'user') {
        $fileResponseLink = asset('storage/common/profile.png');
    }

    if (strpos($file, 'http') !== false) {
        $fileResponseLink = $file;
    } else {
        if ($file != "" || $file != NULL) {
            $fileResponseLink = asset('storage') . '/' . $dirfolder . '/' . $file;
        }
    }

    return $fileResponseLink;
}
// Remove media file
function removeFile($file, $dir) {
    $existImage = storage_path() . '/app/public/' . $dir . '/' . $file;
    if (File::exists($existImage)) {
        File::delete($existImage);
    }
}


function AttributeSet($attrId) {
    global $paramterValues;
    if ($attrId != "") {
        if (isset($paramterValues[$attrId])) {
            return $result = $paramterValues[$attrId];
        }
    }
    return "-";
}
function get_ParameterType() {
    $parameterType    = ParameterType::where("is_active", 1)->orderBy('id', 'desc')->get();
    $arrParameterType = [];
    foreach ($parameterType as $paratype) {
        $varParameterType = [
            'parameter_type_id'   => $paratype->id,
            'parameter_type_name' => $paratype->parameter_type_name,
        ];

        array_push($arrParameterType, $varParameterType);
    }

    return $arrParameterType;
}

function get_UserName($user_id) {
    if ($user_id) {
        return User::where("id", $user_id)->orderBy('id', 'desc')->pluck('user_name');
    }
    return '-';
}

function SetNewBudget($user_id){
    $ParameterValue = ParameterValue::query();
    $parameterValue = $ParameterValue->select('parameter_value','mst_parameter_value.parameter_type_id','mst_parameter_value.id as expense_category_id')
    ->leftjoin('mst_parameter_type as pt', 'parameter_type_id', '=', 'pt.id')
    ->where('mst_parameter_value.is_active','=','1')
    ->orderBy('mst_parameter_value.id', 'asc')
    ->get();

    $Trn_IncomeArray = array();
    $Trn_ExpenseArray = array();
    foreach ($parameterValue as $kData => $vData) {
        if($vData->parameter_type_id==1){
            $Trn_Expense = array(
                'user_id' => $user_id,
                'expense_name' =>$vData->parameter_value,
                'sequence_no' => $kData,
                'created_at' =>  date('Y-m-d H:i:s'),
            );
            $expense_id = DB::table('trn_expense')->insertGetId($Trn_Expense);
            $getSubCategory = DB::table('mst_sub_category')->select('sub_category')
                    ->where('category_id','=',$vData->expense_category_id)
                    ->get();
            foreach ($getSubCategory as $key => $value) {
                $Trn_SubExpense = array(
                    'user_id' => $user_id,
                    'expense_id' => $expense_id,
                    'sub_expense_name' => $value->sub_category,
                    'planned_amount' =>'0',
                    'sequence_no' => $key,
                    'created_at' =>  date('Y-m-d H:i:s'),
                );
                array_push($Trn_ExpenseArray,$Trn_SubExpense);
            }
        }else if($vData->parameter_type_id==2){
            $Trn_Income = array(
                'user_id' => $user_id,
                'income_name' =>$vData->parameter_value,
                'planned_amount' => '0',
                'sequence_no' => $kData,
                'created_at' =>  date('Y-m-d H:i:s'),
            );
            array_push($Trn_IncomeArray,$Trn_Income);
        }
    }
    Trn_Income::insert($Trn_IncomeArray);
    Trn_Expense_Sub::insert($Trn_ExpenseArray);
    return true;
}


function learn_public_path(){
	return asset('/').'storage/Video/';
}

function store_learn_path()
{
    return storage_path() . '/app/public/Video/';
}

function image_public_path(){
	return asset('/').'storage/Content/';
}

function store_image_path()
{
    return storage_path() . '/app/public/Content/';
}

function successResponse($message, $response)
{
    return response([
        'success' => config('constants.validResponse.success'),
        'message' => $message,
        'data'    => $response,
    ], config('constants.validResponse.statusCode'));
}

function invalidResponse($message)
{
    return response([
        'success' => config('constants.invalidResponse.success'),
        'message' => $message,
        'data'    => config('constants.emptyData'),
    ], config('constants.invalidResponse.statusCode'));
}

function validationError($field, $error)
{
    return [
        "message" =>  'The given data was invalid.',
        "errors" => [
            $field => [
                $error
            ]
        ]
    ];
}


function mailSend($dataMail)
{   
    Mail::send('emails.mail', ['bodyHTML' => $dataMail], function ($message) use ($dataMail) {
        $message->from(env('MAIL_FROM_ADDRESS'),env('APP_NAME'))
        ->to($dataMail['email'], $dataMail['name'])
        ->subject($dataMail['subject']);
    });
}

function typeList()
{
    return [ 'image', 'description' ];
}

function sideList()
{
    return [ 'left', 'right', 'center'];
}

function formatDate($date = '', $format = 'Y-m-d'){
    if($date == '' || $date == null)
        return;

    return date($format,strtotime($date));
}