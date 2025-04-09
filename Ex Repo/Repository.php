<?php

class Repository {
    protected PDO $pdo;
    protected string $tableName;

    public function __construct(PDO $pdo, string $tableName) {
        $this->pdo = $pdo;
        $this->tableName = $tableName;
        // Validate table name
        if (empty($this->tableName)) {
            throw new Exception("Table name must not be empty.");
        }
    }

    public function findAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM {$this->tableName}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->tableName} WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function create(array $data): int {
        $columns = array_keys($data);
        $placeholders = array_map(fn($col) => ":{$col}", $columns);
        $sql = "INSERT INTO {$this->tableName} (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $placeholders) . ")";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return (int) $this->pdo->lastInsertId();
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->tableName} WHERE id = ?");
        return $stmt->execute([$id]);
    }
}