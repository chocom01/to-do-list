<?php

namespace App\Core\Database;

use Exception;
use mysqli;
use PDO;

class TaskQueryBuilder extends QueryBuilder
{
    public function selectAll($parameters)
    {
        $sql = "SELECT tasks.id,
                    tasks.name AS name,
                    tasks.name AS task_name,
                    users.name AS user_name,
                    statuses.name AS status_name,
                    priorities.name AS priority_name,
                    CONCAT ( '/task?id=', tasks.id ) AS showTask
            FROM tasks
            JOIN users ON tasks.user_id = users.id
            JOIN statuses ON tasks.status_id = statuses.id
            JOIN priorities ON tasks.priority_id = priorities.id
            ORDER BY {$parameters['orderBy']} {$parameters['sortBy']}, id ASC
            LIMIT :limit OFFSET :offsets";

        $offset = $this->calculateOffset($parameters['page'], $parameters['limit']);

        $statement = $this->pdo->prepare($sql);

        $statement->bindParam(':limit', $parameters['limit'], PDO::PARAM_INT);
        $statement->bindParam(':offsets', $offset, PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function columnNames()
    {
        $sql = "SELECT column_name
                FROM information_schema.columns
                WHERE table_name='tasks'; ";


        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function update($parameters)
    {
        $sql = 'UPDATE tasks 
                SET name = :task_name,
                    user_id = :user_id,
                    status_id = :status_id,
                    priority_id = :priority_id
                WHERE id = :id';

        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute(
                [
                    ':id' => $parameters['id'],
                    ':task_name' => $parameters['name'],
                    ':user_id' => $parameters['user_id'],
                    ':status_id' => $parameters['status_id'],
                    ':priority_id' => $parameters['priority_id']
                ]
            );
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function countRows()
    {
        $statement = $this->pdo->prepare("SELECT COUNT(id) FROM tasks");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    public function select($id)
    {
        return parent::selectById('tasks', $id);
    }

    public function insert($parameters)
    {
        parent::insertByTable('tasks', $parameters);
    }

    public function delete($id)
    {
        parent::deleteByTable('tasks', $id);
    }

    private function calculateOffset($page, $limit)
    {
        if ($page < 2) {
            return 0;
        } else {
            return ($page - 1) * $limit;
        }
    }
}
