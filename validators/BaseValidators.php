<?php

namespace validators;

use debug\Debug;
use helpers\EncriptHelper;
use helpers\Errors;
use helpers\PregMatch;

class BaseValidators
{

    protected $isValid = true;
    protected $messages = [];

    public function timeValidator($postData, $filedNames)
    {
        foreach ($filedNames as $fieldName) {
            if (!empty($postData[$fieldName]) && !preg_match(PregMatch::ALOWED_TIME, $postData[$fieldName])) {
                $this->isValid = false;
                $this->messages[$fieldName] = Errors::ERROR_INVALID_TIME_FORMAT;
            }
        }
    }

    public function textValidator($postData, $filedNames)
    {
        foreach ($filedNames as $filedName) {
            if (!empty($postData[$filedName]) && !preg_match(PregMatch::ALOWED_CARACTERS, $postData[$filedName])) {
                $this->isValid = false;
                $this->messages[$filedName] = Errors::ERROR_INVALID_CHARACTERS;
            }
        }
    }

    public function numberValidator($postData, $filedNames)
    {
        foreach ($filedNames as $filedName) {
            if (!empty($postData[$filedName]) && !preg_match(PregMatch::ALOWED_NUMBERS, $postData[$filedName])) {
                $this->isValid = false;
                $this->messages[$filedName] = Errors::ERROR_INVALID_NUMBERS;
            }
        }
    }

    public function requiredField($postData, $fieldNames)
    {
        foreach ($fieldNames as $fieldName) {
            if (empty($postData[$fieldName])) {
                $this->isValid = false;
                $this->messages[$fieldName] = Errors::ERROR_REQUIRED_FIELD;
            }
        }
    }


    public function verifyPassword($tipedPassword, $existingPassword)
    {
        if (EncriptHelper::verifyPassword($tipedPassword, $existingPassword) !== true) {
            $this->isValid = false;
            $this->messages = Errors::ERROR_USER_LOGIN_FAIL;
        }
    }

// nu imi asum aceasta functie. a fost copiata

    public function CNPvalidator($postData) // functie de validare
    {
        for ($i = 0; $i <= 12; $i++) // imparte fiecare cifra a cnp-ului intr-un vector
        {
            $cnp[] = intval($postData['userCNP'][$i]);
        }

        $suma = $cnp[0] * 2 + $cnp[1] * 7 + $cnp[2] * 9 + $cnp[3] * 1 + $cnp[4] * 4 + $cnp[5] * 6 + $cnp[6] * 3 + $cnp[7] * 5 + $cnp[8] * 8 + $cnp[9] * 2 + $cnp[10] * 7 + $cnp[11] * 9; //caluleaza o suma (face parte din algoritm)

        $rest = $suma % 11; // scoate restul din suma

        if (($rest < 10 && $rest == $cnp[12]) || ($rest == 10 && $cnp[12] == 1)) { // valideaza
            $this->isValid = true;
        }else {
            $this->isValid = false;
            $this->errorMessages = Errors::ERROR_INVALID_CNP;
        }
    }

    public function isValid()
    {
        return $this->isValid;
    }

    public function errorMessages()
    {
        return $this->messages;
    }
// si mai jos e minunatia de cod care am incercat sa o scriu si nu are nici un rezultat
// mai ma nevoie de exercitii cu foreach-uri ca sa le pot stapanii. pana acum am zgariat doar suprafata
// si nu il sterg ca vreau sa continui dupa ce ce termina  hackatlon-ul sa ma simt multumit ca am reusit sa fac validarea cnp-ului
// de aseemenea vreau sa il parametrizez incat sa pot sa validez cnp-urile si din alte tari;

//    public function CNPvalidator($postData)
//    {
//        $constant = "279146358279";
//        $this->numberValidator($postData, ['userCNP']);
//
//        if($this->isValid()){
//            $CNP = $postData['userCNP'];
//            $splitCnp = str_split ($CNP, "1");
//            $splitContant = str_split($constant, "1");
//
//            for ($i = 0; $i <= 12; $i++){
//                $test[] = intval($CNP[$i]);
//            }
////Debug::pre($test);
////Debug::pre($splitCnp);
//
//
//
//
////            foreach($splitCnp as $keya => $a){
////                foreach ($splitContant as $keyb => $b){
////                    $sum[$keyb]  = $a*$b;
////                }
////                Debug::pre($sum);
////            }
//
////Debug::pre($a);
//
//        } else {
//            Debug::pre("isnot valid");
//        }
//
////$count  = count($cnp);
////        Debug::pre($cnp);die;
////        Debug::pre($count);die;
//
//
//    }


}
