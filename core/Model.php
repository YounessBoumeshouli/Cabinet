<?php
namespace Core;

abstract class Model {
    protected $db;
    protected $table;
    protected $relations = [];

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findAll($conditions = [], $relations = []) {
        $query = "SELECT * FROM {$this->table}";
        
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(' AND ', array_map(
                fn($key) => "$key = :$key", 
                array_keys($conditions)
            ));
        }

        $stmt = $this->db->prepare($query);
        $stmt->execute($conditions);
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Charger les relations si demandées
        if (!empty($relations)) {
            foreach ($results as &$result) {
                $this->loadRelations($result, $relations);
            }
        }

        return $results;
    }

    protected function loadRelations(&$record, $relations) {
        foreach ($relations as $relation) {
            if (isset($this->relations[$relation])) {
                $config = $this->relations[$relation];
                $model = new $config['model']();
                
                if ($config['type'] === 'hasMany') {
                    $record[$relation] = $model->findAll([
                        $config['foreignKey'] => $record['id']
                    ]);
                } elseif ($config['type'] === 'belongsTo') {
                    $record[$relation] = $model->findById($record[$config['foreignKey']]);
                }
            }
        }
    }

    public function create($data) {
        $fields = implode(', ', array_keys($data));
        $values = implode(', ', array_map(fn($field) => ":$field", array_keys($data)));
        
        $query = "INSERT INTO {$this->table} ($fields) VALUES ($values) RETURNING id";
        $stmt = $this->db->prepare($query);
        
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function update($id, $data) {
        $fields = implode(', ', array_map(
            fn($field) => "$field = :$field",
            array_keys($data)
        ));
        
        $query = "UPDATE {$this->table} SET $fields WHERE id = :id";
        $stmt = $this->db->prepare($query);
        
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}

