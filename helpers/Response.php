<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace helpers;

/**
 * instrumentul cu care iti ofera placerea de a pedepsi utilizatorul cand greseste sau incearca intentionat sa iti strice aplicatia
 *
 * @author MCristian
 */
class Response
{

    public static function response($success, $message = null, $data = null)
    {
        if ($success) {
            return self::responseTrue($message, $data);
        } else {
            return self::responseFalse($message, $data);
        }
    }

    public static function responseTrue($message = null, $data = null)
    {
        return array('success' => true, 'mesage' => $message, 'data' => $data);
    }

    public static function responseFalse($message = null, $data = null)
    {
        return array('success' => false, 'message' => $message, 'data' => $data);
    }


}
