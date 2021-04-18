<?php

use debug\Debug;

//echo " var";die;
include_once 'config/init.php';

$fileName = "index";
$action = "index";
$urlParams = [];

if (!empty($_GET['_url'])) {

    $url = explode("/", $_GET['_url']);
    if (!empty($url[1])) {
        $fileName = $url[1];
        if (!empty($url[2])) {
            $action = $url[2];
            unset($url[0]);
            unset($url[1]);
            unset($url[2]);
            $urlParams = array_values($url);
        } else {
//            header("location: /$fileName/index");
        }
    }
}

$className = "controllers" . "\\" . ucfirst(strtolower($fileName)) . "Controller";
if (class_exists($className)) {
    $controlInstance = new $className;
    if (method_exists($controlInstance, $action . "Action")) {
        $postData = $_POST;
        $params = array($postData);
        if (!empty($urlParams)) {
            $params[] = $urlParams;
        }

        ///////////////// USEFULL VAR_DUMP //////////////////
//        debug\Debug::pre($params);

        $response = call_user_func_array(array($controlInstance, $action . "Action"), $params);
    } else {
        header("location: /$fileName");
    }

    // $response este disponibila in front-end si contine messajele de eroare pentru campuri
    Debug::pre($response);

//    include_once 'view/index.php';
} else {
    header("location: /");
}

// ce e scris mai sus nu este 100% opera mea. am fost ajutat... deci nu se ia in considerare :D
// si a fost copiat de la un lat proiect care e momentan in paragina si astept designul
// cam inteleg ce se intampla dar nu stapanesc inca tot