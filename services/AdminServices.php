<?php

namespace services;


use controllers\AdminController;
use database\Programs;
use database\Room;
use databases\Admin;
use debug\Debug;
use http\Env\Response;
use validators\Validators;
use services\commonService;

class AdminServices
{
    static function Auth($postData)
    {
        if (!empty($_POST['name'])) {
            $adminDb = new Admin();

        }
        $valid = new Validators();
        $valid->usersValidators();
        if ($valid->isValid()) {
            $adminDb = Admin();
//            $adminDb->
        }
        return $postData;
    }

    static function insertRoom($postData)
    {

        $valid = new Validators();
        $valid->roomValidator($postData);
        if ($valid->isValid()) {
            $insertRoom = new Room();
            $insert = $insertRoom->insertRoom($postData);
            if ($insert) {
                // it dose something like redirect back to list page
            } else {

            }
        }
    }

    static function InsertPrograms($postData)
    {
        $valid = new Validators();
        $valid->programValidator($postData);
        if ($valid->isValid()) {
            $programDb = new Programs();
            $existingPrograms = $programDb->selectByRoomid($postData);
            if (commonService::checkTime($postData['startTime'], $postData['endTime'], $existingPrograms)) {
                echo "inserat";
            } else {
                echo "carapat";
            }
        }
    }

    static function selectRooms()
    {
        $select = new Room();
        return $select->selectALL();
    }

    static function selectPrograms()
    {
        $select = new Programs();
        return $select->selectALL();
    }
}