<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Front\BudgetController;
use App\Http\Controllers\API\Front\UserLearnController;
use App\Http\Controllers\API\Front\FrontUserController;
use App\Http\Controllers\API\Unique\ContactController;

/*  API Routes only user login */
Route::group(['middleware' => 'auth:api'], function () {
    Route::middleware('UserTokenVerify')->group(function () {
        Route::post('setbudget', [BudgetController::class, 'setBudget']);
        Route::post('add_expensegroup', [BudgetController::class, 'add_ExpenseGroup']);
        Route::post('delete_item', [BudgetController::class, 'delete_Item']);
        Route::post('addbudgetitems', [BudgetController::class, 'addBudgetItems']);
        Route::post('updateitemvalues', [BudgetController::class, 'updateItemValues']);
        Route::post('gettransaction', [BudgetController::class, 'getTransaction']);
        Route::post('updatetrnstatus', [BudgetController::class, 'updateTrnStatus']);
        Route::post('updatesubnote', [BudgetController::class, 'updateSubNote']);
        Route::post('addtransactions', [BudgetController::class, 'AddTransactions']);
        Route::post('select2trnlist', [BudgetController::class, 'select2TrnList']);

        Route::group(['prefix' => 'user'], function () {
            Route::post('get_learn_video', [UserLearnController::class, 'getUserLearnVideo']);

            //change password (user-api)
            Route::post('change_password', [FrontUserController::class, 'changePassword']);
            Route::post('profile_update', [FrontUserController::class, 'profileUpdate']);
            Route::get('profile_list', [FrontUserController::class, 'profileList']);

            /* Delete account permanently */
            Route::get('profile_account_delete', [FrontUserController::class, 'profileAccountDelete']);

            Route::post('plan_select', [FrontUserController::class, 'planSelect']);
            Route::post('logout', [FrontUserController::class, 'logout']);

            /* touch with us list store */
            Route::post('touch_us_store', [ContactController::class, 'store']);
        });
    });
});