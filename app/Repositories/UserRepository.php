<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface {
    public function show($id)
    {
        // implementation goes here
    }

    public function create($data)
    {
        return User::create($data);
    }

    public function update($id, $data)
    {
        // implementation goes here
    }

    public function delete($id)
    {
        // implementation goes here
    }
}