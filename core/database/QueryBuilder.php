<?php

class QueryBuilder
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll()
    {
        $statement = $this->pdo->prepare(
            "SELECT tasks.id, tasks.status_id, tasks.priority_id, tasks.user_id,
                    tasks.name AS taskName,
                    statuses.name AS statusName,
                    priorities.name AS priorityName
            FROM tasks
            JOIN statuses ON tasks.status_id = statuses.id
            JOIN priorities ON tasks.priority_id = priorities.id
            ORDER BY tasks.status_id, tasks.priority_id ASC
            ");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectTable($table)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $table");

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

        public function update($table, $parameters)
    {
        $parameterChunks = array_chunk($parameters, 1, true);

        $sql = sprintf(
            'UPDATE %s SET name=%s, user_id=%s, status_id=%s, priority_id=%s where id=%s',
            $table,
            ':' . array_key_first($parameterChunks[0]), // name
            ':' . array_key_first($parameterChunks[4]), // user_id
            ':' . array_key_first($parameterChunks[2]), // status_id
            ':' . array_key_first($parameterChunks[3]), // priority_id
            ':' . array_key_first($parameterChunks[1]) // tasks.id
        );

        try
        {
            $statement = $this->pdo->prepare($sql);

            $statement->execute($parameters);
        }catch (Exception $e) {
            die('woops');
        }
    }

        public function delete($table, $parameters)
    {
        $sql = sprintf(
            'DELETE FROM %s WHERE id=%s',
            $table, ':' . array_key_first($parameters)
        );

        try
        {
            $statement = $this->pdo->prepare($sql);

            $statement->execute($parameters);
        }catch (Exception $e) {
            die('woops');
        }
    }
}