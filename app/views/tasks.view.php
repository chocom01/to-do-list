<?php require('partials/head.php'); ?>
    <title>Tasks</title>

    <style>
        <?php include '../public/css/tasks.css'; ?>
    </style>

    <div class="center">
        <h3>Tasks</h3>
        <?php if (isset($tasks)) : ?>
            <table>
                <tr>
                    <th class="<?= $sortOrder['name']['class'] ?>"
                        onclick="location.href='<?= $sortOrder['name']['query'] ?>'">Name</th>

                    <th class="<?= $sortOrder['user']['class'] ?>"
                        onclick="location.href='<?= $sortOrder['user']['query'] ?>'">Assign</th>

                    <th class="<?= $sortOrder['status']['class'] ?>"
                        onclick="location.href='<?= $sortOrder['status']['query'] ?>'">Status</th>

                    <th class="<?= $sortOrder['priority']['class'] ?>"
                        onclick="location.href='<?= $sortOrder['priority']['query'] ?>'">Priority</th>
                    <th></th>
                </tr>

            <?php foreach ($tasks as $task) : ?>
                <tr>
                    <td> <?= $task->task_name; ?> </td>
                    <td> <?= $task->user_name; ?> </td>
                    <td> <?= $task->status_name; ?> </td>
                    <td> <?= $task->priority_name; ?> </td>
                    <td>
                        <button
                                class="button" onclick="location.href='<?=$task->showTask;?>'" type="button"> Edit
                        </button>
                    </td>
                </tr>
            <?php endforeach ?>
            </table>
        <?php endif; ?>

        <div class="pagination left">
            <h4>Page:</h4>
            <?php foreach ($pages as $page) : ?>
                <?php if ($page == $currentQuery['page']) : ?>
                        <a class="active" href="<?='?' . http_build_query($currentQuery) ?>"> <?=$page;?> </a>
                <?php else : ?>
                        <a href="<?='?' .
                            http_build_query(array_replace($currentQuery, ['page' => $page]))?>">
                            <?=$page;?>
                        </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="pagination right">
            <h4>Items on page:</h4>
            <?php foreach ($limits as $limit) : ?>
                <?php if ($limit == $currentQuery['limit']) : ?>
                        <a class="active" href="<?='?' .
                            http_build_query(array_replace($currentQuery, ['page' => 1]))?>">
                            <?=$limit;?>
                        </a>
                <?php else : ?>
                        <a href="<?='?' .
                            http_build_query(array_replace($currentQuery, ['page' => 1, 'limit' => $limit]))?>">
                            <?=$limit;?>
                        </a>
                <?php endif; ?>
            <?php endforeach ?>
        </div>
    </div>

<?php require('partials/footer.php'); ?>

