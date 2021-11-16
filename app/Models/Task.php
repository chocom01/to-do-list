<?php

namespace App\Models;

use App\Core\App;

class Task
{
    public static function all($parameters): array
    {
        $checkedParameters = self::checkInputSortData($parameters);

        return self::buildQuery()->selectAll($checkedParameters);
    }

    public static function selectById($id): object
    {
        return self::buildQuery()->select($id)[0];
    }

    public static function update($validatedData)
    {
        return self::buildQuery()->update(
            parameters: array_combine(
                array_keys($validatedData),
                array_values($validatedData)
            )
        );
    }

    public function create($validatedData): void
    {
        $columnNames = array_keys($validatedData);
        $columnValues = array_values($validatedData);

        $dataForCreate = array_combine($columnNames, $columnValues);

        self::buildQuery()->insert(
            parameters: $dataForCreate
        );
    }

    public static function delete($id): void
    {
        self::buildQuery()->delete($id);
    }

    public static function countPages($limit): array
    {
        $countRows = self::buildQuery()->countRows()[0];

        if ($limit > $countRows) {
            $pagesCount = 1;
        } else {
            $pagesCount = ceil($countRows / $limit);
        }

        return range(1, $pagesCount);
    }

    private static function checkInputSortData($parameters)
    {
        $taskColumns = array_column(self::buildQuery()->columnNames(), 'COLUMN_NAME');
        $ascDesc = ['asc', 'desc'];

        $checkOrderBy = in_array($parameters['orderBy'], $taskColumns);
        $checkSortBy = in_array($parameters['sortBy'], $ascDesc);

        if (!$checkOrderBy || !$checkSortBy) {
            $parameters['orderBy'] = 'id';
            $parameters['sortBy'] = 'asc';
        }

        return $parameters;
    }

    public static function buildQuery(): object
    {
        return App::get('taskQueryBuilder');
    }
}
