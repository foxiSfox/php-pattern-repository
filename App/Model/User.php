<?php

namespace App\Model;

class User
{
    private $id;
    private $login;
    private $name;
    private $lastName;

    public function __construct(array $fields = [])
    {
        $this->id = $fields['id'] ?? '';
        $this->login = $fields['login'] ?? '';
        $this->name = $fields['name'] ?? '';
        $this->lastName = $fields['lastName'] ?? '';
    }

    public static function toResponse(User $user): array
    {
        return [
            'id' => $user->id,
            'login' => $user->login,
            'name' => $user->name,
            'lastName' => $user->lastName,
        ];
    }
}
