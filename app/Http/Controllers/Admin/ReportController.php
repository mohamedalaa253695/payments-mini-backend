<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function generateBasicReport(Request $request)
    {
        // dd($request->input('start_date'));
        $transactions = DB::table('transactions')
            ->join('payments', 'transactions.id', '=', 'payments.transaction_id')
            ->whereBetween('transactions.due_date', [$request->input('start_date'), $request->input('end_date')])
            ->selectRaw(
                'transactions.id as Transaction_Id,
                sum(payments.amount) as Sum_OF_Payments_Amount,
                month(payments.paid_on) as Payment_Paid_On_Month,
                year(payments.paid_on) as Payment_Paid_On_Year,
                transactions.amount_with_vat as Transaction_Amount_With_Vat,
                transactions.due_date as Due_on,
                transactions.status as Status'
            )
            ->groupBy('transactions.id', 'Due_on', 'Payment_Paid_On_Month', 'Payment_Paid_On_Year', 'Transaction_Amount_With_Vat', 'Status')
            ->get();
        return response($transactions);
    }

    public function generateMonthlyReport(Request $request)
    {
        $transactions = DB::table('transactions')
            ->join('payments', 'transactions.id', '=', 'payments.transaction_id')
            ->whereBetween('transactions.due_date', [$request->input('start_date'), $request->input('end_date')])
            ->selectRaw(
                'transactions.id as Transaction_Id,
            sum(payments.amount) as Sum_OF_Payments_Amount,
            month(payments.paid_on) as Payment_Paid_On_Month,
            year(payments.paid_on) as Payment_Paid_On_Year,
            transactions.amount_with_vat as Transaction_Amount_With_Vat,
            transactions.due_date as Due_on'
            )
            ->groupBy('transactions.id', 'Due_on', 'Payment_Paid_On_Month', 'Payment_Paid_On_Year', 'Transaction_Amount_With_Vat')
            ->get();


        return response($transactions);
    }
}
