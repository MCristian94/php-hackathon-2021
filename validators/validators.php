<?php

namespace validators;

use debug\Debug;
use helpers\EncriptHelper;

class Validators extends BaseValidators
{

    public function usersValidators($postData)
    {
        $this->requiredField($postData, ['name', 'password',]);
        $this->textValidator($postData, ['name']);
        $this->verifyPassword($postData['name'], $existingPassword);
//        $this->matchRawPassword($postData, 'password', 'verifyPassword');
    }

    public function roomValidator($postData)
    {
        $this->requiredField($postData, ['number', 'capacity']);
        $this->numberValidator($postData, ['number']);
        $this->numberValidator($postData, ['capacity']);
    }

    public function programValidator($postData)
    {
        $this->requiredField($postData, ['name', 'startTime', 'endTime', 'roomId']);
        $this->textValidator($postData, ['name']);
        $this->numberValidator($postData, ['roomId']);
        $this->timeValidator($postData, ['startTime', 'endTime']);
    }

    public function userCheck($tipedPassword, $existingPassword)
    {
        $this->verifyPassword($tipedPassword, $existingPassword);
    }

    public function bookingValidator($postData)
    {
        $this->requiredField($postData, ['date', 'startTime', 'endTime', 'userCNP', 'programId', 'roomId']);
        $this->numberValidator($postData, ['programId', 'roomId']);
        $this->timeValidator($postData, ['startTime', 'endTime']);
        $this->CNPvalidator($postData);
    }
}