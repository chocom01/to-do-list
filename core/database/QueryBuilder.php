<?php

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
               WHERE id =  {$id})
        ");

        $statement->execute();

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
        $statement = $this->pdo->prepare("SELECT * FROM $table WHERE id=$id");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function insert($table, $parameters)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(',', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try
        {
            $statement = $this->pdo->prepare($sql);

            $statement->execute($parameters);
        }catch (Exception $e) {
            die('woops');
        }
    }

        public function delete($table, $id)
    {
        $sql = "DELETE FROM {$table} WHERE id={$id['id']}";

        try
        {
            $statement = $this->pdo->prepare($sql);

            $statement->execute();
        }catch (Exception $e) {
            die('woops');
        }
    }
}