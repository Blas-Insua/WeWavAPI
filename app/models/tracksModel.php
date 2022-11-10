<?php

class tracksModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=wewavdb;charset=utf8', 'root', '');
    }

    public function getAll($order, $desc) {
        if ($desc) {
            $query = $this->db->prepare("SELECT * FROM tracks 
                                        INNER JOIN accounts ON tracks.user_id = accounts.id
                                         ORDER BY $order DESC");                       
        } else {
            $query = $this->db->prepare("SELECT * FROM tracks 
                                        INNER JOIN accounts ON tracks.user_id = accounts.id
                                         ORDER BY $order ASC"); 
        }
        $query->execute();
        $tracks = $query->fetchAll(PDO::FETCH_OBJ); 

        return $tracks;
    }

    public function get($id) {
        $query = $this->db->prepare("SELECT * FROM tracks WHERE id = ?");
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
