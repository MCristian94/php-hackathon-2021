<?php


namespace database;


use debug\Debug;

class Bookings extends DataBase
{
    protected $tableName = "bookings";

    public function insertBooking($postData)
    {
        $sql = " INSERT INTO $this->tableName (`date`,`start_time`,`end_time`,`user_cnp`,`program_id`, `room_id` ) VALUE (:date,:start_time,:end_time, :user_cnp, :program_id, :room_id)";
        $data = [
            'date' => $postData['date'],
            'start_time' => $postData['startTime'],
            'end_time' => $postData['endTime'],
            'user_cnp' => $postData['userCNP'],
            'program_id' => $postData['programId'],
            'room_id' => $postData['roomId'],
        ];
        $query = $this->connection->prepare($sql);
        // RETURN in case is needed for future use;
        return $query->execute($data);
    }

    public function updateBooking($postData)
    {
        $sql = "UPDATE $this->tableName SET date = :date, start_time = :start_time, end_time = :end_time, user_cnp = :user_cnp, program_id = :program_id";
        $data = [
            'date' => $postData['date'],
            'start_time' => $postData['startTime'],
            'end_time' => $postData['endTime'],
            'user_cnp' => $postData['userCNP'],
            'program_id' => $postData['programId'],
        ];
        $query = $this->connection->prepare($sql);
        // RETURN in case is needed for future use;
        return $query->execute($data);
    }

    public function selectBookingByCNP($postData)
    {
        $sql = "SELECT * FROM $this->tableName WHERE user_cnp = :user_cnp";
        $data = [
            'user_cnp' => $postData['userCNP'],
        ];
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        return $query->fetchAll();
    }
}