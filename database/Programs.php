<?php


namespace database;


class Programs extends DataBase
{
    protected $tableName = "programs";

    public function insertProgram($postData)
    {
        $sql = " INSERT INTO $this->tableName (`name`,`start_time`,`end_time`,`room_id`) VALUE (:name,:start_time, :end_time, :room_id)";
        $data = [
          'name' => $postData['name'],
          'start_time' => $postData['startTime'],
          'end_time' => $postData['endTime'],
            'room_id' => $postData['roomId'],
        ];
        $query = $this->connection->prepare($sql);
        // RETURN in case is needed for future use;
        return $query->execute($data);
    }

    public function selectByRoomId($postData){
        $sql = "SELECT * FROM $this->tableName WHERE room_id = :room_id";
        $data = [
            'room_id' => $postData['roomId'],
        ];
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        return $query->fetchAll();
    }
}