<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'balance' => $this->balance->amount_available ?? 0,
            'transactions' => $this->transactions->map(function ($trx) {
                return [
                    'trx_id' => $trx->trx_id,
                    'amount' => $trx->amount,
                ];
            }), 
        ];
    }
}
