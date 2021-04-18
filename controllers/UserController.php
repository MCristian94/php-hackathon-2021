<?php


namespace controllers;


use services\UserServices;
use validators\Validators;

class UserController
{
    public function BookingAction()
    {
        // DE REFACTORIZAT ASTA CA NU E OK

        if (!empty($_POST)) {
            $postData = $_POST;
            UserServices::insertBooking($postData);
        } else {

        }
    }

    public function updateAction()
    {
        $postData = $_POST;
        if (isset($postData['id'])) {
            $valid = new Validators();
            $valid->numberValidator($postData, ['id']);
            if ($valid->isValid()) {
                $return['insertBooking'] = UserServices::insertBooking();
            } else {
                // salveaza in loguri de ce nu a existat un id valid
            }
        } else {
            //posibil un redirect ? mai mult ca sigur un redirect catre pannel
        }
        return $return;
    }

    public function deleteAction()
    {
        $postData = $_POST;
        if (isset($postData['id']) && !empty($postData['id'])) {
            $valid = new Validators();
            $valid->numberValidator($postData, ['id']);
            if ($valid->isValid()) {
                UserServices::deleteBooking($postData);
            }
        }
    }
}