<?php
require_once 'CrudInterface.php';

class Rendez_vous implements CrudInterface {
    private $db;
    private $title;
    private $id;
    public function __construct($db,$title,$id) {
        $this->db = $db;
        $this->title = $title;
        $this->id = $id;
    }

    public function create($data) {
        $sql = "INSERT INTO Rendez_vous (description_r) VALUES (:name)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $data['name']);
        return $stmt->execute();
    }

    public function read($id) {
        $sql = "SELECT * FROM Rendez_vous WHERE id_rendez_vous = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
        $sql = "UPDATE Rendez_vous SET name = :name WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM Rendez_vous WHERE id_rendez_vous = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getAll() {
        $sql = "SELECT * FROM Rendez_vous";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    
}

