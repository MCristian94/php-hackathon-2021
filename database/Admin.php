<?php


namespace database;


class Admin extends DataBase


{
    protected $tableName = "admin";

    public function insertAdmin($postData)
    {
        // si aici ar trebui ca primul admin care primeste un e-mail cu tokenul pentru atentificare sa poata sa introduca
        // alti admini daca e nevoie  si sa poata sa isi modifice parola in updateAdmin() care tot in zona o sa fie ;
    }

    public function getAdminName($postData)
    {
        $sql = "SELECT name from $this->tableName WHERE name = :name";
        $data = [
            "name" => $postData['name'],
        ];
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        return $query->fetch();
    }

    public function getAdminPassword($user)
    {
        $sql = "SELECT password FROM $this->tableName WHERE name = :name";
        $data = [
            'name' => $user['name'],
        ];
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        return $query->fetch();
    }
}