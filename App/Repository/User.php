<?php

namespace App\Repository;

use \App\Model\User as UserModel;

class User
{
    public function create(UserModel $user): ?UserModel
    {
        return new UserModel(['id' => '1', 'login' => 'fox', 'name' => 'Pavel', 'lastName' => 'Volkov']);
    }

    public function update(UserModel $user): ?UserModel
    {
        return new UserModel(['id' => '1', 'login' => 'fox', 'name' => 'Pavel', 'lastName' => 'Volkov']);
    }

    public function delete(int $id): bool
    {
        return true;
    }

    public function getList($filter): ?array
    {
        return [
            new UserModel(['id' => '1', 'login' => 'fox', 'name' => 'Pavel', 'lastName' => 'Volkov']),
            new UserModel(['id' => '2', 'login' => 'max', 'name' => 'Max', 'lastName' => 'Markov']),
        ];
    }

    public function getById($id): UserModel
    {
        return new UserModel(['id' => '1', 'login' => 'fox', 'name' => 'Pavel', 'lastName' => 'Volkov']);
    }
}
