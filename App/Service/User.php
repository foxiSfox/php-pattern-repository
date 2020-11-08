<?php

namespace App\Service;

use \App\Model\User as UserModel;
use \App\Repository\User as UserRepository;

class User
{
    public function create(UserModel $user): ?UserModel
    {
        return (new UserRepository)->create($user);
    }

    public function update(UserModel $user): ?UserModel
    {
        return (new UserRepository)->update($user);
    }

    public function delete(int $id): bool
    {
        return (new UserRepository)->delete($id);
    }

    public function getList(array $filter = []): ?array
    {
        return (new UserRepository)->getList($filter);
    }

    public function getById(int $id): ?UserModel
    {
        return (new UserRepository)->getById($id);
    }
}
