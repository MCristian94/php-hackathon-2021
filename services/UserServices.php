<?php


namespace services;


use database\Bookings;
use debug\Debug;
use validators\Validators;

class UserServices
{
    static function insertBooking($postData)
    {
        $valid = new Validators();
        $valid->BookingValidator($postData);
        if ($valid->isValid()) {
            $valid->CNPvalidator($postData, ['userCNP']);
            if ($valid->isValid()) {
                $booking = new Bookings();
                $existingBooking = $booking->selectBookingByCNP($postData);
                if (isset($existingBooking[0]['user_cnp'])) {
                    if ($existingBooking[0]['user_cnp'] === $postData['userCNP']) {
                        if (commonService::checkTime($postData['startTime'], $postData['endTime'], $existingBooking)) {
                            if ($booking->insertBooking($postData)) {
                                echo "inserat";
                            } else {
                                echo "crapat";
                            }
                        }
                    }

                }
            }
        }
    }
}



