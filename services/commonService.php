<?php


namespace services;


class commonService
{
    static function checkTime($NTS, $NTE, $existingPrograms)
    {

        foreach ($existingPrograms as $existingProgram) {
            if (self::checkTimed($NTS, $NTE, $existingProgram['start_time'], $existingProgram['end_time'])) {
                $flag['true'][] = true;
            } else {
                $flag['false'][] = false;
            }
        }
        if(!isset($flag['false'])){
           $flag = true;
        } else {
            $flag = false;
        }
        return $flag;
    }

    static function checkTimed($NTS, $NTE, $start1, $end1)
    {
// formatul timpului din baza de date e 10:00:00 si nu am rabdare sa mai caut o rezolvare mai frumoasa ca sa pot sa tai secundele. de aceea folosesc explode
        /**/                                                //  |
        /**/    $time = explode(":", $end1);        //  |
        /**/    $time2 = explode(":", $start1);     //  |
        /**/    $end1 = $time[0] . ":" . $time[1];          //  |
        /**/    $start1 = $time2[0] . ":" . $time2['1'];    //  |
        //__________________________________________________//  |

        $flag = false;

        if ($end1 <= $NTS && $end1 < $NTE && $end1 !== $NTE) {
            $flag = true;
        } else if ($NTE <= $start1 && $start1 !== $NTS) {
            $flag = true;
        }
        return $flag;
    }
}