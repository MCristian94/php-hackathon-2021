<?php


namespace controllers;


use database\Admin;
use debug\Debug;
use hellpers\AuthHellpers;
use hellpers\EncriptHelper;
use services\AdminServices;
use validators\Validators;

class AdminController
{
    public function indexAction()
    {
        if (!isset($_SESSION['auth'])) {
            if ($_SESSION['auth'] == false) {
                header("location:/admin/auth");
            }
        } else {
            header("location:/admin/pannel");
        }

    }

    public function testAction()
    {
        echo "admin/ tested";
    }

    public function authAction()
    {
        if (!empty($_POST)) {
            $postData = $_POST;
            $valid = new Validators();
            $valid->textValidator($postData, ['name']);
            if ($valid->isValid()) {
                $adminDb = new Admin();
                $user = $adminDb->getAdminName($postData);
                if (count($user) == 1) {
                    $password = $adminDb->getAdminPassword($user);
                    if (EncriptHelper::verifyPassword($postData['password'], $password['password']) == true) {
                        $_SESSION = [
                            'auth' => true,
                            'admin' => $postData['name'],
                        ];
                        header("location:/admin/pannel");
                    } else {
                        /*
                         * $todo errors for rong autentification creditentials;
                         */
                    }
                } else {
                    /*
                     * $todo logs to see why there are more than 1 admin whit the same name OR error messages for rong creditentials;
                     *
                     */
                }
            } else {
                /*
                 * $todo error message for forbiden caraters in name;
                 */
            }
        } else {
            /*
             * $todo error message empty name and/or password;
             */
        }

    }

    public function pannelAction()
    {
        $postData = $_POST;
//            AdminServices::InsertRoom($postData);
//            AdminServices::InsertPrograms($postData);

        $data = [
            'rooms' => AdminServices::selectRooms(),
            'programs' => AdminServices::selectPrograms(),
        ];

        Debug::pre($data);

    }

    public function insertAction()
        // $hidden = "Parametrul de control pentru a putea diferentia formularele care sunt in aceeasi pagina. Stiu ca nu ar fii ideal dar
        // nici ideea ca userul sa vada 1 inputuri si un submit pe fie care pagina :D ";
    {
        if (!empty($_POST)) {
            $postData = $_POST;
            if (isset($postData['hidden']) && ($postData['hidden'] === "room")) {
                AdminServices::insertRoom($postData);
            } else if (isset($postData['hidden']) && ($postData['hidden'] === "program")) {
                AdminServices::InsertPrograms($postData);
            } else {
                //doo something;
            }

        }
    }
}