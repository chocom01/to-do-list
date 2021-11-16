<?php

namespace App\Core\Database;

use Exception;
use PDO;

class QueryBuilder
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function entityExists($table, $id)
    {
        $statement = $this->pdo->prepare("
        SELECT EXISTS(
               SELECT id
               FROM {$table}
               WHERE id = :id)
        ");

        $statement->execute([':id' => $id]);

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    public function selectTable($table)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $table");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectById($table, $id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $table WHERE id = :id");

        $statement->execute([':id' => $id]);

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function insertByTable($table, $parameters)
    {
        $parametersKeys = array_keys($parameters);

        $columnNames = implode(',', $parametersKeys);
        $columnValues = ':' . implode(', :', $parametersKeys);

        $formatQuery = "INSERT INTO %s (%s) VALUES (%s)";
        $sql = sprintf($formatQuery, $table, $columnNames, $columnValues);

        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute($parameters);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteByTable($table, $id)
    {
        $sql = "DELETE FROM {$table} WHERE id = :id";

        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute([':id' => $id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}