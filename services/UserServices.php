<?php


namespace services;


use database\Bookings;
use database\Room;
use debug\Debug;
use helpers\Response;
use validators\Validators;

class UserServices
{
    static function insertBooking($postData)
    {
        $valid = new Validators();
        $valid->BookingValidator($postData);

        if ($valid->isValid()) {
            $booking = new Bookings();
            $booked = $booking->selectALL();

            $room = new Room();
            $roomCapacity = $room->getRoomCapacityByRoomId($postData);
            foreach ($booked as $roomFilled) {
                $count[] = $roomFilled['room_id'];
            }
            $counted = count($count);
            if ($counted < $roomCapacity['capacity']) {
                echo "inca e acceptat";
                $existingBooking = $booking->selectBookingByCNP($postData);
                if (isset($existingBooking[0]['user_cnp'])) {

                    // aici ar trebui sa fac un refactor masiv... revin daca mai am timp

                    if ($existingBooking[0]['user_cnp'] === $postData['userCNP']) {
                        if (commonService::checkTime($postData['startTime'], $postData['endTime'], $existingBooking)) {
                            echo "redy to go";
                            if ($booking->insertBooking($postData)) {
                                echo "inserat";
                            } else {
                                echo "crapat";
                            }
                        }
                    }
                }
            } else {
                return Response::responseFalse("nu mai sunt locuri disponibile");
            }
        } else {
            return Response::responseFalse($valid->errorMessages());
        }
    }

    static function updateBooking($postData)
    {
        $valid = new Validators();
        $valid->bookingValidator($postData);
        if ($valid->isValid()) {

            // refactor masiv ca nu sunt bine definite lucrurile ... la fel revin daca mai am timp si puteri
            $booking = new Bookings();
            $existingBooking = $booking->selectBookingByCNP($postData);
            if (isset($existingBooking[0]['user_cnp'])) {
                if ($existingBooking[0]['user_cnp'] === $postData['userCNP']) {
                    if (commonService::checkTime($postData['startTime'], $postData['endTime'], $existingBooking)) {
                        if ($booking->updateBooking($postData)) {
                            echo "inserat";
                        } else {
                            echo "crapat";
                        }
                    }
                }
            }
        } else {
            return Response::responseFalse($valid->errorMessages());
        }
    }

    static function deleteBooking($postData)
    {
        // ar trebui sa il las sa poata sa isi stearga programarile pe rand in cazul in care are mai multe dar
        // asta este o poveste pentru o alta zi :D
        // dar recunosc ca m-am distrat putin si de data asta am fost pregatit :D
        $delete = new Bookings();
        return Response::response($delete->delete($postData), "clasicul ne pare rau ca pleci");
    }
}



