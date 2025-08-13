<?php

namespace Modules\PaymentWithdraw\app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\PaymentWithdraw\app\Models\WithdrawMethod;

class WithdrawMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $withdrawMethods = WithdrawMethod::orderBy('id', 'desc')->paginate(20);
        return view('paymentwithdraw::admin.withdraw-methods.index', compact('withdrawMethods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('paymentwithdraw::admin.withdraw-methods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'minimum_amount' => 'required|numeric|min:0',
            'maximum_amount' => 'required|numeric|min:0',
            'withdraw_charge' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'boolean'
        ]);

        WithdrawMethod::create($request->all());

        return redirect()->route('admin.withdraw-methods.index')
            ->with('success', 'Withdraw method created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $withdrawMethod = WithdrawMethod::findOrFail($id);
        return view('paymentwithdraw::admin.withdraw-methods.show', compact('withdrawMethod'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $withdrawMethod = WithdrawMethod::findOrFail($id);
        return view('paymentwithdraw::admin.withdraw-methods.edit', compact('withdrawMethod'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'minimum_amount' => 'required|numeric|min:0',
            'maximum_amount' => 'required|numeric|min:0',
            'withdraw_charge' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'boolean'
        ]);

        $withdrawMethod = WithdrawMethod::findOrFail($id);
        $withdrawMethod->update($request->all());

        return redirect()->route('admin.withdraw-methods.index')
            ->with('success', 'Withdraw method updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $withdrawMethod = WithdrawMethod::findOrFail($id);
        $withdrawMethod->delete();

        return redirect()->route('admin.withdraw-methods.index')
            ->with('success', 'Withdraw method deleted successfully.');
    }
}