<?php


namespace controllers;


use database\Admin;
use debug\Debug;
use hellpers\AuthHellpers;
use hellpers\EncriptHelper;
use helpers\Response;
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

                    // ar trebui sa introduc in baza de date si parola encodata ca sa functioneze autentificarea...

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
        // listarea camerelor si a programelor creeate
        $data = [
            'rooms' => AdminServices::selectRooms(),
            'programs' => AdminServices::selectPrograms(),
        ];
        return $data;
    }

    public function insertAction()
    {
        // $hidden = "Parametrul de control pentru a putea diferentia formularele care sunt in aceeasi pagina. Stiu ca nu ar fii ideal dar
        // nici ideea ca userul sa vada 1 inputuri si un submit pe fie care pagina :D ";

        if (!empty($_POST)) {
            $postData = $_POST;
            if (isset($postData['hidden']) && ($postData['hidden'] === "room")) {
                $return['insertRoom'] = AdminServices::insertRoom($postData);
            } else if (isset($postData['hidden']) && ($postData['hidden'] === "program")) {
                $return['insertPrograms'] = AdminServices::InsertPrograms($postData);
            } else {
                // nu ar trebui sa se ajunga aici si nici nu stiu ce comportament ar trebui sa aiba apicatia... dar in teorie trebuie sa ii dau peste mana ca incearca sa strice aplicatia;
                return "Rong Way";
            }
        } else {
            // la prima accesare a paginii nu trebuie sa ai mesaje de eroare ca e normal ca, campurile sa fie goale (pana infloresc florile dupa sunt pline cu flori)
            return Response::responseFalse("");
        }
        return $return;
    }

    public function updateAction()
    {
        if (!empty($_POST)) {
            $postData = $_POST;
            if (isset($postData['id'])) {
                $valid = new Validators();
                $valid->numberValidator($postData, ['id']);
                if ($valid->isValid()) {
                    if (isset($postData['hidden']) && ($postData['hidden'] === "room")) {
                        $return['updateRoom'] = AdminServices::updateRoom($postData);
                    } else if (isset($postData['hidden']) && ($postData['hidden'] === "program")) {
                        $return['updatePrograms'] = AdminServices::updatePrograms($postData);
                    } else {
                        // salvat in log pentru a vedea de ce nu a existat ce trebuie in $postData['hidden'];
                        return Response::responseFalse("lispeste hidden input");
                    }
                } else {
                    return Response::responseFalse($valid->errorMessages());
                }
            } else {
                // ar trebui sa il timita inapoi in pannel si sa se salveze intr-un log de ce nu a existat un id valid
                // (trebuie sa ma mai joc cu logurile pentru ca inca nu stiu cum se fac :D)
            }
        } else {
            // camp gol messaje N/A
            return Response::responseFalse("");
        }
        return $return;
    }

    public function deleteAction()
    {
        if (isset($postData['id'])) {
            $valid = new Validators();
            $valid->numberValidator($postData, ['id']);
            if ($valid->isValid()) {
                if (isset($postData['hidden']) && ($postData['hidden'] === "room")) {
                    $return['deleteRoom'] = AdminServices::deleteRoom($postData);
                } else if (isset($postData['hidden']) && ($postData['hidden'] === "program")) {
                    $return['deletePrograms'] = AdminServices::deletePrograms($postData);
                } else {
                    // salvat in log pentru a vedea de ce nu a existat ce trebuie in $postData['hidden'];
                }
            } else {
                // ar trebui sa fie un redirect catre pannel
            }
        } else {
            //la fel de redirect catre pannel
        }
        return $return;
    }
}