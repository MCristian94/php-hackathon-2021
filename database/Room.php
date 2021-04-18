<?php


namespace database;


class Room extends DataBase
{
    protected $tableName = "rooms";

    public function insertRoom($postData)
    {
        $sql = " INSERT INTO $this->tableName (`number`, `capacity`) VALUES (:number, :capacity)";
        $data = [
            'number' => $postData['number'],
            'capacity' => $postData['capacity'],
        ];
        $query = $this->connection->prepare($sql);
        // RETURN for future verification if data was inserted in database;
        return $query->execute($data);
    }


}