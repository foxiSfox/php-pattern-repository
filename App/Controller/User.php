<?php

namespace App\Controller;

use \App\Model\User as UserModel;
use \App\Service\User as UserService;
use \App\Response;

class User
{
    public function create(UserModel $user): ?array
    {
        $createdUser = (new UserService)->create($user);
        return Response::success(UserModel::toResponse($createdUser));
    }

    public function update(UserModel $user): ?array
    {
        $updatedUser = (new UserService)->update($user);
        return Response::success(UserModel::toResponse($updatedUser));
    }

    public function delete(int $id): bool
    {
        return Response::success((new UserService)->delete($id));
    }

    public function getList(array $filter = []): ?array
    {
        $users = (new UserService())->getList($filter);
        $users = array_map(
            function ($u) {
                return UserModel::toResponse($u);
            },
            $users
        );
        return Response::success($users);
    }

    public function getById(int $id): ?array
    {
        $user = (new UserService)->getById($id);
        return Response::success(UserModel::toResponse($user));
    }
}
