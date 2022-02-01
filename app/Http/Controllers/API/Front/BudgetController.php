<?php
namespace App\Http\Controllers\API\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\User;
use App\Models\Trn_Expense;
use App\Models\Trn_Expense_Sub;
use App\Models\Trn_Income;
use App\Models\Trn_Transaction_Log;
use App\Models\Trn_Expense_Transaction;
use App\Models\Trn_Income_Transaction;

use DB,Hash;

class BudgetController extends Controller
{
    public function setBudget(Request $request) {
        $data = $request->validate([
            'currentDate' => 'required',
        ]);
        $currentDate = $request->currentDate;
        $StartDate = date("Y-m-1 00:00:00", strtotime($currentDate));
        $EndDate = date("Y-m-31 23:59:59", strtotime($currentDate));

        $mainArray =array();
        $trnIncome = Trn_Income::select('id as income_id','income_name','planned_amount as planned','note')
                                ->where('user_id', auth()->user()->id)
                                ->whereBetween('created_at', [$StartDate, $EndDate])
                                ->orderBy('sequence_no', 'asc')                    
                                ->get()->toArray();
        

        foreach ($trnIncome as $ktrnIncome => $vtrnIncome) {
            $trnIncomeTransaction = DB::table('trn_income_transaction')
                            ->select('id','income_id',
                            DB::raw("(SELECT income_name FROM trn_income as ti WHERE ti.id = trn_income_transaction.income_id) as sub_category"),
                            'title','amount','transaction_check','transaction_note','date_time')
                            ->where('income_id','=',$vtrnIncome['income_id'])
                            ->whereIn('status', ['2'])
                            ->whereBetween('created_at', [$StartDate, $EndDate])
                            ->get()->toArray();
            $received = array_sum(array_column($trnIncomeTransaction,'amount'));

            $progress_bar = 0;
            if($vtrnIncome['planned'] > 0){
                $progress_bar = ($received / $vtrnIncome['planned']) * 100;
            }
            $trnIncome[$ktrnIncome]['received'] =$received;
            $trnIncome[$ktrnIncome]['progress_bar'] =round($progress_bar,2);
            $trnIncome[$ktrnIncome]['total_transaction'] = count($trnIncomeTransaction);
            $trnIncome[$ktrnIncome]['Transactions'] =$trnIncomeTransaction;
        }
        $mainArray['Income'] = $trnIncome;


        $trnExpense = Trn_Expense::select('id as expense_id','expense_name','type')
                                ->where('user_id', auth()->user()->id)
                                ->whereBetween('created_at', [$StartDate, $EndDate])
                                ->orderBy('sequence_no', 'asc')                    
                                ->get()->toArray();
        $total_expense_limit=0;
        $trnFavorites =array();
        $exTransactionArray = array();
        $i=0;
        foreach ($trnExpense as $ktrnExpense => $vtrnExpense) {
            
            $trnExpenseSub = Trn_Expense_Sub::select('id as expense_sub_id','sub_expense_name','is_favorite','expense_id','note','planned_amount as limit','created_at')
                            ->where('expense_id','=',$vtrnExpense['expense_id'])
                            ->whereBetween('created_at', [$StartDate, $EndDate])
                            ->orderBy('sequence_no', 'asc')
                            ->get()->toArray();
            
            foreach ($trnExpenseSub as $ktrnExpenseSub => $vtrnExpenseSub) {
                $trnExpenseTransaction = DB::table('trn_expense_transaction')
                            ->select('id','expense_sub_id',
                            DB::raw("(SELECT sub_expense_name FROM trn_expense_sub as ti WHERE ti.id = trn_expense_transaction.expense_sub_id) as sub_category"),
                            'title','amount','transaction_check','transaction_note','date_time')
                            ->where('expense_sub_id','=',$vtrnExpenseSub['expense_sub_id'])
                            ->whereBetween('created_at', [$StartDate, $EndDate])
                            ->whereIn('status', ['2'])
                            ->get()->toArray();
                
               
                $totalExpense = array_sum(array_column($trnExpenseTransaction,'amount'));
                $progress_bar = 0;
                if($vtrnExpenseSub['limit'] > 0){
                    $progress_bar = ($totalExpense / $vtrnExpenseSub['limit']) * 100;
                }
               
                $trnExpenseSub[$ktrnExpenseSub]['total_spent'] = $totalExpense;
                $trnExpenseSub[$ktrnExpenseSub]['left_spend'] = ($vtrnExpenseSub['limit'] - $totalExpense) ;
                $trnExpenseSub[$ktrnExpenseSub]['progress_bar'] = round($progress_bar,2);
                $trnExpenseSub[$ktrnExpenseSub]['total_transaction'] = count($trnExpenseTransaction);
                // $trnExpenseSub[$ktrnExpenseSub]['Transactions'] =$trnExpenseTransaction;
              
                $exTransactionArray[$i]['Transactions']=$trnExpenseTransaction; 
                $exTransactionArray[$i]['total_transaction']=count($trnExpenseTransaction); 
                $exTransactionArray[$i]['category']=$vtrnExpense['expense_name']; 
                $exTransactionArray[$i]['total_spent']=$totalExpense;
                $exTransactionArray[$i]['progress_bar']=round($progress_bar,2);
                $exTransactionArray[$i]['limit']=$vtrnExpenseSub['limit'];
                $exTransactionArray[$i]['note']=$vtrnExpenseSub['note']; 
                $exTransactionArray[$i]['sub_category']=$vtrnExpenseSub['sub_expense_name'];
                $exTransactionArray[$i]['expense_sub_id']=$vtrnExpenseSub['expense_sub_id']; 
             
                $i++;
                if($vtrnExpenseSub['is_favorite']== 1){
                    $vtrnExpenseSub['total_spent'] = $totalExpense;
                    $vtrnExpenseSub['left_spend'] = ($vtrnExpenseSub['limit'] - $totalExpense) ;
                    $vtrnExpenseSub['progress_bar'] = round($progress_bar,2);
                    $vtrnExpenseSub['total_transaction'] = count($trnExpenseTransaction);
                    $trnFavorites[]=$vtrnExpenseSub;
                }

            }
            $total_category_limit = array_sum(array_column($trnExpenseSub,'limit'));
            $total_category_spent = array_sum(array_column($trnExpenseSub,'total_spent'));
            $total_category_percentage=0;
            if($total_category_limit > 0){
                $total_category_percentage= ($total_category_spent / $total_category_limit ) * 100;
            }

            $trnExpense[$ktrnExpense]['total_category_limit'] = $total_category_limit;
            $trnExpense[$ktrnExpense]['total_category_spent'] = $total_category_spent;
            $trnExpense[$ktrnExpense]['total_category_percentage'] = round($total_category_percentage ,2);
            $trnExpense[$ktrnExpense]['expense_sub'] = $trnExpenseSub;
            $total_expense_limit += array_sum(array_column($trnExpenseSub,'limit'));

        }
        $mainArray['Income'] = $trnIncome;
        $mainArray['Expense'] = $trnExpense;
        $mainArray['Favorites'] = $trnFavorites;
        $mainArray['ExpenseTransaction'] = $exTransactionArray;

        $response['total_income_planned'] = array_sum(array_column($trnIncome,'planned'));
        $response['total_income_received'] = array_sum(array_column($trnIncome,'received'));
        $response['total_expense_limit'] = $total_expense_limit;

        $response['total_expense_spent'] = array_sum(array_column($trnExpense,'total_category_spent'));
        $response['total_balance'] = array_sum(array_column($trnIncome,'received'))-array_sum(array_column($trnExpense,'total_category_spent'));

        $response['grand_budget'] = (array_sum(array_column($trnIncome,'planned')) - $total_expense_limit);
        $response['response'] = $mainArray;

        if($mainArray['Expense']){
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => 'Data get successfully',
                'data'    => $response,
            ], config('constants.validResponse.statusCode'));
        }else{
            return response([
                'success' => config('constants.invalidResponse.success'),
                'message' => 'Hey there, looks like you need a budget for February.',
                'data'    => [],
            ], config('constants.validResponse.statusCode'));
        }

       
    }
  
    public function updateTrnStatus(Request $request) {
        $data = $request->validate([
            'id' => 'required',
            'status' => 'required',
            'trnType' => 'required',
            'original_status' => 'required',
        ]);

        if($request->trnType == 'expense'){
            $updateFlag = ($request->status==3?$request->original_status:"3");

            DB::update('update trn_expense_transaction set status="' . $updateFlag . '",deleted_at="' .date('Y-m-d H:i:s') . '" where id="' . $request->id . '"');
        }else if($request->trnType == 'income'){
            $updateFlag = ($request->status==3?$request->original_status:"3");
            DB::update('update trn_income_transaction set status="' . $updateFlag . '",deleted_at="' . date('Y-m-d H:i:s') . '" where id="' . $request->id . '"');
        }
        return response([
            'success' => config('constants.validResponse.success'),
            'message' => 'successfully.',
            'data'    => '',
        ], config('constants.validResponse.statusCode'));

    }
    public function select2TrnList(Request $request) {
        $data = $request->validate([
            'currentDate' => 'required',
        ]);
        $currentDate = $request->currentDate;
        $StartDate = date("Y-m-1 00:00:00", strtotime($currentDate));
        $EndDate = date("Y-m-31 23:59:59", strtotime($currentDate));
        
        $trnIncome = Trn_Income::select('id','income_name as text',
        DB::raw("'income' as type") )
        ->where('user_id', auth()->user()->id)
        ->whereBetween('created_at', [$StartDate, $EndDate])
        ->orderBy('sequence_no', 'asc')                    
        ->get()->toArray();
       
        $incomeArray[] = [
            'id'  => '1',
            'text'    => 'Income',
            'children' => $trnIncome,
        ];
        
        $trnExpense = Trn_Expense::select('id','expense_name as text')
        ->where('user_id', auth()->user()->id)
        ->where('type','1')
        ->whereBetween('created_at', [$StartDate, $EndDate])
        ->orderBy('sequence_no', 'asc')                    
        ->get()->toArray();
        
        $expenseArray = array();
        foreach ($trnExpense as $ktrnExpense => $vtrnExpense) {
            $trnExpenseSub = Trn_Expense_Sub::select('id','sub_expense_name as text',DB::raw("'expense' as type"))
                ->where('expense_id','=',$vtrnExpense['id'])
                ->whereBetween('created_at', [$StartDate, $EndDate])
                ->orderBy('sequence_no', 'asc')
                ->get()->toArray();
            $expenseArray[] = [
                    'id'  => $vtrnExpense['id'],
                    'text'    => $vtrnExpense['text'],
                    'children' => $trnExpenseSub,
                ];
        }
        $TransactionArray = array();
        $TransactionArray = array_merge($incomeArray,$expenseArray);

        if($TransactionArray){
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => 'Data get successfully',
                'data'    => $TransactionArray,
            ], config('constants.validResponse.statusCode'));
        }else{
            return response([
                'success' => config('constants.invalidResponse.success'),
                'message' => 'Hey there, looks like you need a budget for February.',
                'data'    => [],
            ], config('constants.validResponse.statusCode'));
        }
    }

    public function getTransaction(Request $request) {
        $data = $request->validate([
            'currentDate' => 'required',
        ]);
        $currentDate = $request->currentDate;
        $StartDate = date("Y-m-1 00:00:00", strtotime($currentDate));
        $EndDate = date("Y-m-31 23:59:59", strtotime($currentDate));
        $trnIncomeTransaction = DB::table('trn_income_transaction');
        $trnExpenseTransaction = DB::table('trn_expense_transaction');

        if(@$request->searchData != "") {
            $trnIncomeTransaction->where('title', 'like', '%' . $request->searchData . '%');
            $trnExpenseTransaction->where('title', 'like', '%' . $request->searchData . '%');
        }
        $IncomeTrnData = $trnIncomeTransaction->select('id',
                DB::raw("'income' as type"),
                DB::raw("(SELECT income_name FROM trn_income as ti
                WHERE ti.id = trn_income_transaction.income_id) as sub_category"),'income_id','amount','title','transaction_check','transaction_note','original_status','status','date_time','deleted_at')
            ->where('user_id', auth()->user()->id)
            ->whereBetween('created_at', [$StartDate, $EndDate])
            ->orderBy('date_time', 'desc')
            ->get()->toArray();
        
        $ExpenseTrnData = $trnExpenseTransaction->select('id',
                DB::raw("'expense' as type"),
                DB::raw("(SELECT sub_expense_name FROM trn_expense_sub as tes
                WHERE tes.id = trn_expense_transaction.expense_sub_id) as sub_category"),'expense_sub_id','amount','title','transaction_check','transaction_note','original_status','status','date_time','deleted_at')
            ->where('user_id', auth()->user()->id)
            ->whereBetween('created_at', [$StartDate, $EndDate])
            ->orderBy('date_time', 'desc')
            ->get()->toArray();

        $TransactionArray = array();

        $Transaction = array_merge($IncomeTrnData,$ExpenseTrnData);
        array_multisort(array_map('strtotime',array_column($Transaction,'date_time')),SORT_DESC,$Transaction);
        foreach ($Transaction as $kTransaction => $vTransaction) {
            // return $vTransaction->status;
            if($vTransaction->status == 1){
                $TransactionArray['New'][] = $vTransaction;
            }else if($vTransaction->status == 2){
                $TransactionArray['Tracked'][] = $vTransaction;
            }else if($vTransaction->status == 3){
                $TransactionArray['Deleted'][] = $vTransaction;
                array_multisort(array_map('strtotime',array_column($TransactionArray['Deleted'],'deleted_at')),SORT_DESC,$TransactionArray['Deleted']);
            }
            
        }
        
        return response([
            'success' => config('constants.validResponse.success'),
            'message' => 'Data get successfully',
            'data'    => $TransactionArray,
        ], config('constants.validResponse.statusCode'));
    }
    public function updateSubNote(Request $request) {
        $data = $request->validate([
            'type' => 'required',
            'id' => 'required',
            'value' => 'required',
        ]);
        if($request->type == 'income'){
            Trn_Income::find($request->id)
            ->update([
                'note' => $request->value,
            ]);
        }else if($request->type == 'expense'){
            Trn_Expense_Sub::find($request->id)
            ->update([
                'note' => $request->value,
            ]);
        }
        return response([
            'success' => config('constants.validResponse.success'),
            'message' => 'Data save successfully',
            'data'    => [],
        ], config('constants.validResponse.statusCode'));
    }
    public function delete_Item(Request $request) {
        $data = $request->validate([
            'id' => 'required',
            'type' => 'required',
        ]);
        if($request->type == 'income'){
            $deleteItem = Trn_Income::where('id', '=', $request->id)->delete();
            DB::table('trn_income_transaction')->where('income_id', '=', $request->id)->delete();
            DB::table('trn_transaction_log')->where('category_id', '=', $request->id)->delete();
        }else if($request->type == 'expense'){
            $deleteItem = Trn_Expense_Sub::where('id', '=', $request->id)->delete();
            DB::table('trn_expense_transaction')->where('expense_sub_id', '=', $request->id)->delete();
            DB::table('trn_transaction_log')->where('category_id', '=', $request->id)->delete();
        }
       
        if ($deleteItem) {
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => 'Item deleted successfully',
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
    public function add_ExpenseGroup(Request $request) {
        $sequence_no = Trn_Expense::select('sequence_no')
        ->where('user_id', auth()->user()->id)
        ->orderBy('sequence_no', 'desc')                    
        ->first();
        if($sequence_no==''){
            $sequence_no['sequence_no']=0;
        }
        $insertArray = array(
            'user_id' => auth()->user()->id,
            'type' =>'2',
            'expense_name' =>'Untitled',
            'sequence_no' => $sequence_no['sequence_no']+1,
            'created_at' =>  date('Y-m-d H:i:s'),
        );
        $saveGroup = Trn_Expense::insert($insertArray);

        if($saveGroup){
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => 'Group added successfully',
                'data'    => [],
            ], config('constants.validResponse.statusCode'));
        }
        return response([
            'success' => config('constants.invalidResponse.success'),
            'message' => 'Something went wrong',
            'data'    => [],
        ], config('constants.invalidResponse.statusCode'));
    }
    public function addBudgetItems(Request $request) {
        $data = $request->validate([
            'type' => 'required',
            'id' => 'required',
        ]);
        if($request->type == 'income'){
            $sequence_no = Trn_Income::select('sequence_no')
            ->where('user_id', auth()->user()->id)
            ->orderBy('sequence_no', 'desc')                    
            ->first();
            if($sequence_no==''){
                $sequence_no['sequence_no']=0;
            }
            $insertArray = array(
                'user_id' => auth()->user()->id,
                'income_name' => 'Paycheck',
                'planned_amount' => '0',
                'sequence_no' => $sequence_no['sequence_no']+1,
                'created_at' =>  date('Y-m-d H:i:s'),
            );
            $saveitems = Trn_Income::insert($insertArray);
            if($saveitems){
                return response([
                    'success' => config('constants.validResponse.success'),
                    'message' => 'Paycheck added successfully',
                    'data'    => [],
                ], config('constants.validResponse.statusCode'));
            }
        }else{
            $sequence_no = Trn_Expense_Sub::select('sequence_no')
            ->where('expense_id', $request->id)
            ->orderBy('sequence_no', 'desc')                    
            ->first();
            if($sequence_no==''){
                $sequence_no['sequence_no']=0;
            }
            $insertArray = array(
                'expense_id' => $request->id,
                'sub_expense_name' => 'Label',
                'planned_amount' => '0',
                'sequence_no' => $sequence_no['sequence_no']+1,
                'created_at' =>  date('Y-m-d H:i:s'),
            );
            $saveitems = Trn_Expense_Sub::insert($insertArray);
            if($saveitems){
                return response([
                    'success' => config('constants.validResponse.success'),
                    'message' => 'Paycheck added successfully',
                    'data'    => [],
                ], config('constants.validResponse.statusCode'));
            }
        }
        return response([
            'success' => config('constants.invalidResponse.success'),
            'message' => 'Something went wrong',
            'data'    => [],
        ], config('constants.invalidResponse.statusCode'));

    }
    public function AddTransactions(Request $request) {
        $data = $request->validate([
            'transactionData' => 'required',
            'original_status' => 'required', 
            'isSplit' => 'required',
            'amount' => 'required',
            'title' => 'required',
            'original_status' => 'required',
            'modal_date' => 'required',
        ]);
        $TableName = ($request->transactionType=="income"?"trn_income_transaction":"trn_expense_transaction");
        $transactionData = json_decode($request->transactionData, true);
        
        $Trn_IncomeArray = array();
        $Trn_ExpenseArray = array();

        $insertBatch = array();
        $updateBatch = array();
        
        // $checkIds = DB::table($TableName)->select('id')
        // ->where('user_id','=',auth()->user()->id)
        // ->get()->toArray();
        // $trnIdOfdata = array_column($checkIds, 'id');
        // return $request;
        foreach ($transactionData as $ktransactionData => $vtransactionData) {
            if($request->transactionType=="income"){
                $saveData = Trn_Income_Transaction::updateOrCreate(
                    ['id' => $vtransactionData['transaction_id']], [
                        'user_id' => auth()->user()->id,
                        'income_id'=> $vtransactionData['sub_category_id'],
                        'amount'=> $vtransactionData['amount'],
                        'title'=> $request->title,
                        'transaction_check'=> $request->transaction_check,
                        'transaction_note'=> $request->transaction_note,
                        'original_status' =>  $request->original_status,
                        'status'=> $request->original_status,
                        'date_time'=> $request->modal_date,
                    ]);
                DB::commit();

            }else if($request->transactionType=="expense"){
                // $Trn_SubExpense = array(
                //     'user_id' => auth()->user()->id,
                //     'expense_sub_id' => $vtransactionData['sub_category_id'],
                //     'amount' => $vtransactionData['amount'],
                //     'title' =>$request->title,
                //     'transaction_check' =>$request->transaction_check,
                //     'transaction_note' => $request->transaction_note,
                //     'status' =>  $request->original_status,
                //     'date_time' =>  $request->modal_date,
                // );
                $saveData = Trn_Expense_Transaction::updateOrCreate(
                    ['id' => $vtransactionData['transaction_id']], [
                        'user_id' => auth()->user()->id,
                        'expense_sub_id'=> $vtransactionData['sub_category_id'],
                        'amount'=> $vtransactionData['amount'],
                        'title'=> $request->title,
                        'transaction_check'=> $request->transaction_check,
                        'transaction_note'=> $request->transaction_note,
                        'original_status' =>  $request->original_status,
                        'status'=> $request->original_status,
                        'date_time'=> $request->modal_date,
                    ]);
                DB::commit();

                // if (in_array($vtransactionData['transaction_id'], $trnIdOfdata)) {
                //     $data1 = array(
                //         'updated_at' => date("Y-m-d H:i:s"),
                //     );
                //     $finalData = array_merge($Trn_SubExpense, $data1);
                   
                // }else{
                //     $data1 = array(
                //         'original_status' =>  $request->original_status,
                //         'created_at' => date("Y-m-d H:i:s"),
                //     );
                //     $finalData = array_merge($Trn_SubExpense, $data1);
                // }
                
            }

        }

        if ($saveData) {
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => "transaction save successfully",
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
    public function updateItemValues(Request $request) {
        $data = $request->validate([
            'type' => 'required',
            'id' => 'required',
            'value' => 'required',
            'amount' => 'required',
        ]);
        if($request->type == 'income'){
            Trn_Income::find($request->id)
            ->update([
                'income_name' => $request->value,
                'planned_amount' => $request->amount,
            ]);
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => 'updated successful!',
            ], config('constants.validResponse.statusCode'));
        }else if($request->type == 'expense'){
            Trn_Expense_Sub::find($request->id)
            ->update([
                'sub_expense_name' => $request->value,
                'planned_amount' => $request->amount,
            ]);
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => 'updated successful!',
            ], config('constants.validResponse.statusCode'));
        }else if($request->type == 'expenseCategory'){
            Trn_Expense::find($request->id)
            ->update([
                'expense_name' => $request->value,
            ]);
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => 'updated successful!',
            ], config('constants.validResponse.statusCode'));
        }
    }
}
