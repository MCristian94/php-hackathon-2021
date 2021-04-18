<?php

namespace debug;

class Debug
{
    static function pre($data)
    {
        $debug = "<pre>" . var_dump($data) . "</pre>";
        return $debug;
    }
}