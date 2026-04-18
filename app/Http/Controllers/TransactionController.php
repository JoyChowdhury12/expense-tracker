<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', Carbon::now()->format('Y-m'));
        
        try {
            $parsedDate = Carbon::parse($month);
        } catch (\Exception $e) {
            $parsedDate = Carbon::now();
            $month = $parsedDate->format('Y-m');
        }
        
        $query = Transaction::where('user_id', Auth::id())
            ->whereMonth('date', $parsedDate->month)
            ->whereYear('date', $parsedDate->year);

        $transactions = $query->orderBy('date', 'desc')->get();

        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        $expenseByCategory = $transactions->where('type', 'expense')
            ->groupBy('category')
            ->map(function ($row) {
                return $row->sum('amount');
            });

        return view('dashboard', compact('transactions', 'month', 'totalIncome', 'totalExpense', 'balance', 'expenseByCategory'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'category' => $request->category,
            'amount' => $request->amount,
            'date' => $request->date,
        ]);

        $month = Carbon::parse($transaction->date)->format('Y-m');

        return redirect()->route('dashboard', ['month' => $month])->with('success', 'Transaction added successfully.');
    }

    public function edit(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'type' => 'required|in:income,expense',
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        $transaction->update($request->only('type', 'category', 'amount', 'date'));

        $month = Carbon::parse($transaction->date)->format('Y-m');

        return redirect()->route('dashboard', ['month' => $month])->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $month = Carbon::parse($transaction->date)->format('Y-m');

        $transaction->delete();

        return redirect()->route('dashboard', ['month' => $month])->with('success', 'Transaction deleted successfully.');
    }
}
