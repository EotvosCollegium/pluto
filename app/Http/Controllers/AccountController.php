<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id = auth()->user()->id;
        $income_sum = DB::table('accounts')->where('user_id', '=', $id)->where('income', true)->sum('amount'); //int
        $expense_sum = DB::table('accounts')->where('user_id', '=', $id)->where('income', false)->sum('amount'); //int
        $accounts = DB::table('accounts')
                        ->where('user_id', '=', $id)
                        ->orderBy('created_at', 'desc')
                        ->get();
        
        return view('accounts.index', [
            'accounts' => $accounts,
            'income_sum' => $income_sum,
            'expense_sum' => $expense_sum
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $income = false;
        if ($request->income) {
            $income = true;
        }

        $cash = false;
        if ($request->cash) {
            $cash = true;
        }
        
        
        $account = Account::create([
            'amount' => $request->amount,
            'notes' => $request->notes,
            'income' => $income,
            'cash' => $cash,
            'user_id' => $request->user()->id,
        ]);
        $account->assigned_users()->attach($request->user()->id);
        return back()->with('message', __('Succesfully created'));
                                    //a toast message will appear, see layouts.app.blade
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        return view('accounts.edit', [
            'account' => $account,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $income = false;
        if ($request->income) {
            $income = true;
        }

        $cash = false;
        if ($request->cash) {
            $cash = true;
        }

        $account->update([
            'amount' => $request->amount,
            'notes' => $request->notes,
            'income' => $income,
            'cash' => $cash,
    ]);

        return back()->with('message', __('Succesfully updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        DB::table('account_user')->where('account_id', '=', $account->id)->delete();
        DB::table('accounts')->where('id', '=', $account->id)->delete();
        return back()->with('message', __('Deleted'));
    }
}
