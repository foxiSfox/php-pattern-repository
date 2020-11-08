<?php

namespace App;

class Response
{
    const SUCCESS = 'HTTP/1.0 200 OK';
    const ERROR = 'HTTP/1.0 400 Bad Request';

    public static function success($data)
    {
        header(self::SUCCESS);
        return $data;
    }

    public static function error($data)
    {
        header(self::ERROR);
        return $data;
    }
}
