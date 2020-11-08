<?php

namespace App;

class Utils
{
    public static function getBodyParams(): array
    {
        return json_decode(file_get_contents('php://input'), true) ?: [];
    }
}
