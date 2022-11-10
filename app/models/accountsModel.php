<?php

class accountsModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=wewavdb;charset=utf8', 'root', '');
    }

    public function getAll() {
        $query = $this->db->prepare("SELECT * FROM accounts");
        $query->execute();
        $accounts = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $accounts;
    }

    public function get($id) {
        $query = $this->db->prepare("SELECT * FROM accounts WHERE id = ?");
        $query->execute([$id]);
        $account = $query->fetch(PDO::FETCH_OBJ);
        
        return $account;
    }

    public function search($param) {
        $query = $this->db->prepare("SELECT * FROM accounts WHERE name = ? OR AKA = ?");
        $query->execute([$param, $param]);
        $account = $query->fetch(PDO::FETCH_OBJ);
        
        return $account;
    }

    public function create($name, $AKA, $password, $genre_id, $country_id) {
        $query = $this->db->prepare("INSERT INTO accounts (name, AKA, password, genre_id, country_id) VALUES (?, ?, ?, ?, ?)");
        $query->execute([$name, $AKA, $password, $genre_id, $country_id]);

        return $this->db->lastInsertId();
    }

    function delete($id) {
        $query = $this->db->prepare('DELETE FROM accounts WHERE id = ?');
        $query->execute([$id]);
    }

    public function update($id, $name, $AKA, $password, $genre_id, $country_id) {
        $query = $this->db->prepare('UPDATE tracks SET name = ?, AKA = ?, password = ?, genre_id = ?, country_id = ? WHERE id = ?');
        $query->execute([$name, $AKA, $password, $genre_id, $country_id, $id]);
    }
}
