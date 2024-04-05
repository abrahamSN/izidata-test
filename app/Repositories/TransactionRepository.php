<?php

namespace App\Repositories;

use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Balance;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function getAll($page = 1)
    {
        $res = Cache::remember('getAllTrx-' . $page, '60', function () {
            return User::with('balance')->paginate(25);
        });

        return $res;
    }

    public function create(array $trxDetail)
    {
        DB::beginTransaction();

        try {
            Transaction::create([
                'trx_id' => $trxDetail['trx_id'],
                'user_id' => $trxDetail['user_id'],
                'amount' => $trxDetail['amount'],
            ]);

            $balance = Balance::where('user_id', $trxDetail['user_id'])->first();
            $balance->amount_available -= $trxDetail['amount'];
            $balance->save();

            sleep(30);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getBalance($userId)
    {
        $res = Cache::remember('getBalance-' . $userId, '30', function () use ($userId) {
            return Balance::where('user_id', $userId)->first();
        });

        return $res;
    }
}
