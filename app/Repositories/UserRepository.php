<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function show($id)
    {
        // implementation goes here
    }

    public function create($data)
    {
        DB::beginTransaction();

        try {
            $user = User::create($data);

            $user->balance()->create([
                'amount_available' => 5000,
            ]);

            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
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
