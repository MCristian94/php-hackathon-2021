<?php


namespace controllers;


use services\UserServices;

class UserController
{
    public function BookingAction()
    {
        if(!empty($_POST)){
            $postData = $_POST;
            UserServices::insertBooking($postData);
        }
    }
}