<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Admin\AdminLoginController;
use App\Http\Controllers\API\Admin\DashboardController;
use App\Http\Controllers\API\Admin\ParameterTypeController;
use App\Http\Controllers\API\Admin\ParameterValueController;
use App\Http\Controllers\API\Admin\SubCategoryController;
use App\Http\Controllers\API\Admin\UserController;
use App\Http\Controllers\API\Admin\RevenueController;
use App\Http\Controllers\API\Admin\PlanController;
use App\Http\Controllers\API\Admin\LearnController;
use App\Http\Controllers\API\Unique\ContactController;
use App\Http\Controllers\API\Admin\AdminContentController;

/*  API Routes only login admin  */

Route::group(['middleware' => 'auth:api'], function () {
    Route::middleware('AdminTokenVerify')->group(function () {
        Route::post('get_dashboard', [DashboardController::class, 'getDashboard']);
        Route::post('notification_counts', [UserController::class, 'notificationCounts']);
    
        Route::post('notificationlist', [UserController::class, 'notificationList']);
        Route::post('change_password', [UserController::class, 'changePassword']);

        Route::get('admin_profile_list', [UserController::class, 'profileList']);

        Route::post('get_parameter_type', [ParameterTypeController::class, 'getParameterType']);
    
        Route::post('parameter_type_datatable', [ParameterTypeController::class, 'parameterTypeDatatable']);
        Route::post('actionparametertype', [ParameterTypeController::class, 'updateOrCreateParameterType']);
        Route::post('parametertype_changestatus', [ParameterTypeController::class, 'parameterTypeChangeStatus']);
        Route::post('deleteparametertype', [ParameterTypeController::class, 'deleteParameterType']);
    
        Route::post('parameter_value_datatable', [ParameterValueController::class, 'parameterValueDatatable']);
        Route::post('actionparametervalue', [ParameterValueController::class, 'updateOrCreateParameterValue']);
        Route::post('parametervalue_changestatus', [ParameterValueController::class, 'parameterValueChangeStatus']);
        Route::post('deleteparametervalue', [ParameterValueController::class, 'deleteParameterValue']);
        
        Route::post('user_datatable', [UserController::class, 'userDatatable']);
        Route::post('user_changestatus', [UserController::class, 'userChangeStatus']);
        Route::post('notification_datatable', [UserController::class, 'notificationDatatable']);
    
        
        Route::post('revenue_datatable', [RevenueController::class, 'revenueDatatable']);
        Route::post('revenue_changestatus', [RevenueController::class, 'revenueChangeStatus']);

        Route::post('plan_datatable', [PlanController::class, 'planDatatable']);
        Route::post('plan_changestatus', [PlanController::class, 'planChangeStatus']);
        Route::post('deleteplan', [PlanController::class, 'deletePlan']);
        Route::post('actionplan', [PlanController::class, 'updateOrCreatePlan']);
        Route::post('get_permission', [PlanController::class, 'getPermission']);
        Route::post('add_permission', [PlanController::class, 'addPermission']);


        Route::post('get_plan_features', [PlanController::class, 'getPlanFeatures']);
        Route::post('save_planfeatures', [PlanController::class, 'savePlanFeatures']);
        Route::post('delete_planfeatures', [PlanController::class, 'deletePlanFeatures']);
        Route::post('get_plan', [PlanController::class, 'getPlan']);


        Route::post('learn_datatable', [LearnController::class, 'learnDatatable']);
        Route::post('actionlearn', [LearnController::class, 'updateOrCreateLearn']);
        Route::post('learn_changestatus', [LearnController::class, 'learnChangeStatus']);
        Route::post('deletelearn', [LearnController::class, 'deleteLearn']);
        Route::post('get_learnvideo', [LearnController::class, 'getLearnVideo']);

        Route::post('learn_video_datatable', [LearnController::class, 'learnVideoDatatable']);
        Route::post('deletelearnvideo', [LearnController::class, 'deleteLearnVideo']);

        Route::post('get_category', [SubCategoryController::class, 'getCategory']);
        Route::post('subcategory_datatable', [SubCategoryController::class, 'subCategoryDatatable']);
        Route::post('actionsubcategory', [SubCategoryController::class, 'updateOrCreateSubCategory']);
        Route::post('subcategory_changestatus', [SubCategoryController::class, 'subCategoryChangeStatus']);
        Route::post('deletesubcategory', [SubCategoryController::class, 'deleteSubCategory']);

        Route::group(['prefix' => 'admin'], function () {
            Route::post('touch_us_datatable', [ContactController::class, 'touchUsDatatable']);
            Route::post('touch_us_datatable/delete', [ContactController::class, 'touchUsDelete']);
            Route::post('touch_us_datatable/show', [ContactController::class, 'touchUsShow']);
            
            /* Content start */
            Route::post('content_form', AdminContentController::class);
            /* Tags Content api's */
            Route::post('get_content_tags/list', [AdminContentController::class, 'contentTagList']);
            Route::post('get_content_tags/datatable', [AdminContentController::class, 'tagDatatable']);
            Route::post('content_tag_store', [AdminContentController::class, 'contentTagStore']);
            Route::post('content_tag_update', [AdminContentController::class, 'contentTagUpdate']);
            Route::post('content_tag_delete', [AdminContentController::class, 'contentTagDelete']);
            Route::post('content_tag_status_change', [AdminContentController::class, 'contentTagStatusChange']);
        
            /* Page Content api's */
            Route::post('get_content_pages/list', [AdminContentController::class, 'contentPageList']);
            Route::post('get_content_pages/datatable', [AdminContentController::class, 'pageDatatable']);
            Route::post('content_page_store', [AdminContentController::class, 'contentPageStore']);
            Route::post('content_page_update', [AdminContentController::class, 'contentPageUpdate']);
            Route::post('content_page_delete', [AdminContentController::class, 'contentPageDelete']);
            Route::post('content_page_status_change', [AdminContentController::class, 'contentPageStatusChange']);

            /* About Us, Contact Us & other Content api's */
            Route::post('get_content/list', [AdminContentController::class, 'contentsList']);
            Route::post('get_content/datatable', [AdminContentController::class, 'contentsDatatable']);
            Route::post('content_store', [AdminContentController::class, 'contentStore']);
            Route::post('content_update', [AdminContentController::class, 'contentUpdate']);
            Route::post('content_delete', [AdminContentController::class, 'contentDelete']);
            Route::post('content_status_change', [AdminContentController::class, 'contentStatusChange']);
        });
    });
});