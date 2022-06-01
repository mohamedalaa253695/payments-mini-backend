<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{

    public function index()
    {

        $transactions = DB::table('transactions')
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->join('subcategories', 'transactions.subcategory_id', '=', 'subcategories.id')
            ->join('users', 'transactions.customer_id', '=', 'users.id')
            ->select(
                'transactions.id as ID',
                'users.name as Payer',
                'categories.name as category',
                'subcategories.name as subcategory',
                'transactions.amount as Amount',
                'transactions.status as Status',
                'transactions.due_date as Due on'
            )
            ->paginate(10);


        return $transactions;
        // return  response(new TransactionResource($transaction), Response::HTTP_ACCEPTED);
    }

    public function store(Request $request)
    {
        Gate::authorize('edit', 'transactions');
        $due_date = $request->input('due_date');
        $nowDate = Carbon::now();
        $isCurrentDateGreaterThanDueDate = $nowDate->gt($due_date);
        $status = $isCurrentDateGreaterThanDueDate == TRUE ? 'overdue' : 'outstanding';

        // dd($request->input('is_vat_inclusive'));
        $amountWithVat = $request->input('is_vat_inclusive') == 1 ? $request->input('amount') :  $request->input('amount') + ($request->input('amount') * ($request->input('vat') / 100));
        $transaction = Transaction::create([
            'category_id' => $request->input('category_id'),
            'due_date' => $due_date,
            'subcategory_id' => $request->input('subcategory_id'),
            'amount' => $request->input('amount'),
            'customer_id' => $request->input('customer_id'),
            'vat' => $request->input('vat'),
            'is_vat_inclusive' =>  $request->input('is_vat_inclusive'),
            'status' => $status,
            'amount_with_vat' => $amountWithVat
        ]);

        return response(new TransactionResource($transaction), Response::HTTP_CREATED);
    }

    public function show(Transaction $transaction)
    {
        return  Transaction::find($transaction->id);
    }

    public function getTransactionPayments(Transaction $transaction)
    {
        return  Transaction::find($transaction->id)->payments()->get();
    }
}
