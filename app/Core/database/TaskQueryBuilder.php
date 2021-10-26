<?php

class TaskQueryBuilder extends QueryBuilder
{
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

    public function update($table, $parameters)
    {
        $sql ="update {$table} 
                set name='{$parameters['name']}',
                    user_id={$parameters['user_id']},
                    status_id={$parameters['status_id']},
                    priority_id={$parameters['priority_id']}
                where id={$parameters['id']}";

        try
        {
            $statement = $this->pdo->prepare($sql);

            $statement->execute();
        }catch (Exception $e) {
            die('woops');
        }
    }
}