<?php


namespace database;


class Room extends DataBase
{
    protected $tableName = "rooms";

    public function insertRoom($postData)
    {
        $sql = "INSERT INTO $this->tableName (`number`, `capacity`) VALUES (:number, :capacity)";
        $data = [
            'number' => $postData['number'],
            'capacity' => $postData['capacity'],
        ];
        $query = $this->connection->prepare($sql);
        // RETURN for future verification if data was inserted in database;
        return $query->execute($data);
    }

    public function updateRoom($postData)
    {
        $sql = "UPDATE $this->tableName SET number = :number, capacity = :capacity WHERE id = :id ";
        $data = [
            'id' => $postData['id'],
            'number' => $postData['number'],
            'capacity' => $postData['capacity'],
        ];
        $query = $this->connection->prepare($sql);
        // RETURN for future verification if data was inserted in database;
        return $query->execute($data);
    }

    public function getRoomCapacityByRoomId($postData)
    {
        $sql = "SELECT capacity FROM $this->tableName WHERE id = :id ";
        $data = [
            'id' => $postData['roomId'],
        ];
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        return $query->fetch();
    }
}