<?php

namespace App\Interfaces;

interface UserRepositoryInterface {
    public function show($userId);
    public function create(array $userDetail);
    public function update($userId, array $newDetail);
    public function delete($userId);
}