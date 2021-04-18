<?php

namespace services;


use controllers\AdminController;
use database\Programs;
use database\Room;
use databases\Admin;
use debug\Debug;
use helpers\Errors;
use helpers\Response;
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
            if ($insertRoom->insertRoom($postData)) {
                // it dose something like redirect back to list page
                return Response::responseTrue("");
            } else {
                return Response::responseFalse("erroare la inserare");
            }
        } else {
            return Response::responseFalse($valid->errorMessages());
        }
    }

    static function updateRoom($postData)
    {
        $valid = new Validators();
        $valid->roomValidator();
        if ($valid->isValid()) {
            $update = new Room();
            $updated = $update->updateRoom($postData);
            if ($update) {
                return Response::response($updated, "inserat cu succes");
            } else {
                return Response::response($updated, "NEINSERAT cu succes");
            }
        } else {
            return Response::responseFalse($valid->errorMessages());
        }
    }

    static function deleteRoom($postData)
    {
        $delete = new Room();
        return Response::response($delete->delete($postData), "BYE");
    }

    static function InsertPrograms($postData)
    {
        $valid = new Validators();
        $valid->programValidator($postData);
        if ($valid->isValid()) {
            $programDb = new Programs();
            $existingPrograms = $programDb->selectByRoomid($postData);

            //TREBUIE MUTATA IN VALIDATORS CA SA POT SA II FAC RETURN-UL CUM TREBUIE SI SA PRIMESC MESSAJELE DE EROARE

            $checkTimeStatus = commonService::checkTime($postData['startTime'], $postData['endTime'], $existingPrograms);
            if ($checkTimeStatus) {
                if ($programDb->insertProgram($postData)) {
                    return Response::responseTrue("inserat cu succes");
                } else {
                    return Response::responseFalse("nu a fost inserat");
                }
            } else {
                return Response::response($checkTimeStatus, "something bad hapend");
            }

        } else {
            return Response::responseFalse($valid->errorMessages());
        }
    }

    static function updatePrograms($postData)
    {
        $valid = new Validators();
        $valid->programValidator($postData);
        if ($valid->isValid()) {
            $update = new Programs();
            $updated = $update->updateProgram();
            if ($updated) {
                return Response::response($updated, "inserat cu succes");
            } else {
                return Response::response($updated, "erroare la inserare");
            }
        } else {
            return Response::responseFalse($valid->errorMessages());
        }
    }

    static function deletePrograms($postData)
    {
        $delete = new Programs();
        return Response::response($delete->delete($postData), "BYE");
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