<?php

namespace App\Interfaces;

interface TransactionRepositoryInterface {
    public function getAll($userId);
    public function create(array $trxDetail);
    public function getBalance($userId);
}