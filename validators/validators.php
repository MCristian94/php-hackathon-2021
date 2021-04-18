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
        $this->numberValidator($postData,['capacity']);
    }

    public function programValidator($postData)
    {
        $this->requiredField($postData, ['name','startTime', 'endTime', 'roomId']);
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
        $this->requiredField($postData, ['date', 'startTime', 'endTime', 'userCNP', 'programId']);
        $this->numberValidator($postData, ['programId']);
        $this->timeValidator($postData, ['startTime', 'endTime']);


    }

    public function powerValidator($postData)
    {
        $this->requiredField($postData, ['name']);
        $this->textValidator($postData, ['name']);
    }


    public function airplaneValidators($postData)
    {
        $this->requiredField($postData, ['name', 'description', 'grouping', 'style', 'dificulty', 'hover']);
        $this->textValidator($postData, ['name', 'description', 'hover']);
        $this->radioValidator($postData, ['grouping', 'style', 'dificulty']);

    }
    public function ribonValidator($postData, $postFile)
    {
        $this->requiredField($postData, ['name', 'description']);
        $this->textValidator($postData, ['name', 'description']);
        $this->photoValidator($postFile, ['photo'], "jpg");
    }

    public function deleteValidators($postData)
    {
        //$this->requiredField($postData, ['delete']);
        $this->numberValidator($postData, ['delete']);
    }

    public function adminUserUpdate ($postData)
    {
        $this->requiredField($postData, ['firstName', 'secondName', 'inGameName', 'grade', 'power']);
        $this->textValidator($postData, ['firstName', 'secondName', 'inGameName', 'grade', 'power']);
    }

    public function manouversInsert($postData, $fileData)
    {
        $this->requiredField($postData, ['name', 'deparment', 'category', 'mode', 'style']);
        $this->textValidator($postData, ['name', 'deparment', 'category', 'mode', 'style', 'description']);
        $this->photoValidator($fileData);
    }

    public function insertDepartmentValidator($postData)
    {
        $this->requiredField($postData,['name']);
        $this->textValidator($postData, ['name']);
    }

    public function updateDepartmentValidtor($postData)
    {
        $this->requiredField($postData, ['name' , 'category']);
        $this->textValidator($postData,['name' , 'category']);
    }

}
