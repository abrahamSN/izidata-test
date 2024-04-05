<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResouce;
use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TransactionController extends Controller
{
    private TransactionRepositoryInterface $trxRepo;

    public function __construct(TransactionRepositoryInterface $trxRepo)
    {
        $this->trxRepo = $trxRepo;
    }

    public function getAll(Request $request)
    {
        $page = $request->query('page', 1);

        $res = $this->trxRepo->getAll($page);

        return TransactionResouce::collection($res);
    }

    public function create(Request $request)
    {
        $request->validate([
            'trx_id' => 'required|unique:transactions',
            'amount' => 'required|numeric'
        ]);

        if ($request->amount == 0.00000001) {
            return response()->json([
                'message' => 'decline'
            ], 400);
        }

        $user = $request->user();

        $balance = $this->trxRepo->getBalance(
            $user->id
        );

        if ($balance->amount_available < $request->amount || $balance->amount_available == null) {
            return response()->json([
                'message' => 'insufficient balance'
            ], 400);
        }

        $this->trxRepo->create([
            'user_id' => $user->id,
            'trx_id' => $request->trx_id,
            'amount' => $request->amount
        ]);

        return response()->json([
            'transaction' => $user->transactions->last(),
            'balance' => $user->balance->amount_available
        ]);
    }
}
