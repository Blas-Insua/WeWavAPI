<?php

class accountsModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=wewavdb;charset=utf8', 'root', '');
    }

    public function getAll($order, $desc, $pagination, $field, $req) {
        if ($desc==true) {
            $query = $this->db->prepare("SELECT a.*, c.country, g.genre, r.rol
                                        FROM accounts a
                                        INNER JOIN countries c ON a.country_id = c.id
                                        INNER JOIN genres g ON a.genre_id = g.id                                        
                                        INNER JOIN roles r ON a.rol_id = r.id                                        
                                        WHERE $field LIKE ?
                                        ORDER BY $order DESC 
                                        $pagination ");                       
        } else {
            $query = $this->db->prepare("SELECT a.*, c.country, g.genre, r.rol
                                        FROM accounts a
                                        INNER JOIN countries c ON a.country_id = c.id
                                        INNER JOIN genres g ON a.genre_id = g.id                                        
                                        INNER JOIN roles r ON a.rol_id = r.id                                        
                                        WHERE $field LIKE ?
                                        ORDER BY $order ASC 
                                        $pagination");  
        }

        $query->execute([$req]);
        $accounts = $query->fetchAll(PDO::FETCH_OBJ); 

        return $accounts;
    }

    public function get($id) {
        $query = $this->db->prepare("SELECT a.*, c.country, g.genre, r.rol 
                                    FROM accounts a
                                    INNER JOIN countries c ON a.country_id = c.id
                                    INNER JOIN genres g ON a.genre_id = g.id                                        
                                    INNER JOIN roles r ON a.rol_id = r.id   
                                    WHERE a.id = ?");
        $query->execute([$id]);
        $account = $query->fetch(PDO::FETCH_OBJ);
        
        return $account;
    }

    public function search($param) {
        $query = $this->db->prepare("SELECT a.*, c.country, g.genre, r.rol 
                                    FROM accounts a
                                    INNER JOIN countries c ON a.country_id = c.id
                                    INNER JOIN genres g ON a.genre_id = g.id                                        
                                    INNER JOIN roles r ON a.rol_id = r.id 
                                    WHERE a.name = ? OR a.AKA = ?");
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
