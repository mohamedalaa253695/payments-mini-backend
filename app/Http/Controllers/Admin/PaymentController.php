<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        Gate::authorize('view', 'payments');

        $request->validate([
            'transaction_id' => 'required',
            'amount' => 'required',
            'paid_on' => 'required'
        ]);

        $payment =  Payment::create([
            'transaction_id' => $request->input('transaction_id'),
            'amount' => $request->input('amount'),
            'paid_on' => $request->input('paid_on'),
            'details' => $request->input('details') ? $request->input('details') : ' ',
        ]);

        return response(new PaymentResource($payment), Response::HTTP_CREATED);
    }
}
