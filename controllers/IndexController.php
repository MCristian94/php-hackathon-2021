<?php

namespace controllers;


use debug\Debug;
class IndexController
{
    public function indexAction()
    {
        $var ="hello World";
var_dump($var);
        return $var;
    }
}