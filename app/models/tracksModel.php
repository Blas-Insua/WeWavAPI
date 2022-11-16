<?php

class tracksModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=wewavdb;charset=utf8', 'root', '');
    }

    public function getAll($order, $desc, $pagination, $field, $req) {        
        if ($desc==true) {
            $query = $this->db->prepare("SELECT t.*, a.name AS user_name, a.AKA AS user_AKA, g.genre  
                                        FROM tracks t
                                        INNER JOIN accounts a ON t.user_id = a.id
                                        INNER JOIN genres g ON t.genre_id = g.id                                        
                                        WHERE $field LIKE ?
                                        ORDER BY $order DESC 
                                        $pagination ");                       
        } else {
            $query = $this->db->prepare("SELECT t.*, a.name AS user_name, a.AKA AS user_AKA, g.genre  
                                        FROM tracks t
                                        INNER JOIN accounts a ON t.user_id = a.id
                                        INNER JOIN genres g ON t.genre_id = g.id                                        
                                        WHERE $field LIKE ?
                                        ORDER BY $order ASC 
                                        $pagination");  
        }

        $query->execute([$req]);
        $tracks = $query->fetchAll(PDO::FETCH_OBJ); 

        return $tracks;
    }

    public function get($id) {
        $query = $this->db->prepare("SELECT t.*, a.name AS user_name, a.AKA AS user_AKA, g.genre  
                                    FROM tracks t
                                    INNER JOIN accounts a ON t.user_id = a.id
                                    INNER JOIN genres g ON t.genre_id = g.id                                        
                                    WHERE t.id = ?");
        $query->execute([$id]);
        $tracks = $query->fetch(PDO::FETCH_OBJ);
        
        return $tracks;
    }

    public function upload($name, $user_id, $genre_id, $date) {
        $query = $this->db->prepare("INSERT INTO tracks (name, user_id, genre_id, date) VALUES (?, ?, ?, ?)");
        $query->execute([$name, $user_id, $genre_id, $date]);

        return $this->db->lastInsertId();
    }

    function delete($id) {
        $query = $this->db->prepare('DELETE FROM tracks WHERE id = ?');
        $query->execute([$id]);
    }

    public function update($id, $name, $user_id, $genre_id, $date) {
        $query = $this->db->prepare('UPDATE tracks SET name = ?, user_id = ?, genre_id = ?, date = ? WHERE id = ?');
        $query->execute([$id, $name, $user_id, $genre_id, $date]);
    }
}
