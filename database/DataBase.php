<?php

namespace database;

use PDO;

class DataBase
{
    public function __construct()
    {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        $link = 'mysql:host=' . DB_HOSTNAME . '; dbname=' . DB_DATABASE . ';charset=utf8';
        $connection = new PDO($link, DB_USERNAME, DB_PASSWORD, $options);
        $this->connection = $connection;
    }

    public function selectALL(){
        $sql = "SELECT * FROM $this->tableName";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function delete($postData)
    {
        $sql = "DELETE ALL FROM $this->tableName WHERE id = :id";
        $data = [
            'id' => $postData['id'],
        ];
        $query = $this->connection->prepare($sql);
        // RETURN for future confirmation that data was deleted;
        return $query->execute($data);

    }
}