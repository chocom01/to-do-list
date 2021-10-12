<?php require('partials/head.php'); ?>

<h2>Edit tasks</h2>

    <?php foreach ($tasks as $task): ?>

        <form method="POST" action="update_task">
            <strong>Title:</strong> <?= $task->taskName; ?>
            <label> <strong>Assign to:</strong>

                <select name="user_id">
                    <?php foreach ($users as $user): ?>
                        <?php if($user->id == $task->user_id) : ?>
                            <option selected="selected" value="<?= $user->id; ?>"><?= $user->name; ?></option>
                        <?php else: ?>
                            <option value="<?= $user->id; ?>"><?= $user->name; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </label>

            <label> <strong>Status:</strong>

                <select name="status_id">
                    <?php foreach ($statuses as $status): ?>
                        <?php if($status->id == $task->status_id) : ?>
                            <option selected="selected" value="<?= $status->id; ?>"><?= $status->name; ?></option>
                        <?php else: ?>
                            <option value="<?= $status->id; ?>"><?= $status->name; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </label>

            <label> <strong>Priority:</strong>

                <select name="priority_id">
                    <?php foreach ($priorities as $priority): ?>
                        <?php if($priority->id == $task->priority_id) : ?>
                            <option selected="selected" value="<?= $priority->id; ?>"><?= $priority->name; ?></option>
                        <?php else: ?>
                            <option value="<?= $priority->id; ?>"><?= $priority->name; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </label>

            <label>
                <input name="id" type="hidden" value=<?=$task->id;?> />
                <input name="task_name">
            </label>

            <button type="submit" >Update</button>

            <button type="submit" formaction="delete_task" >Delete</button>
        </form>

    <?php endforeach; ?>


    <h2>Create task</h2>

    <form method="POST" action="tasks">
        <li>
            <label>name
                <input name="task_name"/>
            </label>
        </li>

        <li>
            <label> Assign to:
                <select name="user_id">
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user->id; ?>"><?= $user->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
        </li>

        <li>
            <label> Status:
                    <select name="status_id">
                        <?php foreach ($statuses as $status): ?>
                           <option value="<?= $status->id; ?>"><?= $status->name; ?></option>
                        <?php endforeach; ?>
                    </select>
            </label>
        </li>

        <li>
            <label> Priority:
                    <select name="priority_id">
                        <?php foreach ($priorities as $priority): ?>
                        <option value="<?= $priority->id; ?>"> <?= $priority->name; ?> </option>
                        <?php endforeach; ?>
                    </select>
            </label>
        </li>

        <button type="submit">Submit</button>

    </form>

<?php require('partials/footer.php'); ?>