<?php

namespace App\Http\Controllers;

use App\Helpers\AuditHelper;
use App\Models\Applicant;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Applicant $applicant)
    {
        return view('payments.create', compact('applicant'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Applicant $applicant)
    {
        $data = $request->validate([
            'amount' => 'required|numeric|min:0',
            'paid_on' => 'required|date',
        ]);

        $applicant->payments()->create($data);

        AuditHelper::log('Created', 'Payment', 'Added payment for applicant: ' . $applicant->full_name);
        return redirect()->route('applicants.show', $applicant)->with('success', 'Payment recorded.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Applicant $applicant, Payment $payment)
    {
        return view('payments.edit', compact('applicant', 'payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Applicant $applicant, Payment $payment)
    {
        $data = $request->validate([
            'amount' => 'required|numeric|min:0',
            'paid_on' => 'required|date',
        ]);

        $payment->update($data);

        AuditHelper::log('Updated', 'Payment', 'Updated payment for applicant: ' . $applicant->full_name);
        return redirect()->route('applicants.show', $applicant)->with('success', 'Payment updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Applicant $applicant, Payment $payment)
    {
        $payment->delete();

        AuditHelper::log('Deleted', 'Payment', 'Deleted payment for applicant: ' . $applicant->full_name);
        return redirect()->route('applicants.show', $applicant)->with('success', 'Payment deleted.');
    }
}
