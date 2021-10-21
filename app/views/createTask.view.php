<?php require('partials/head.php'); ?>

<h2>Create task</h2>

    <form method="POST" action="create_task">
        <li>
            <label>name
                <input name="task_name" value="<?=$invalidData['task_name'];?>"/>
                <?php if(isset($errors['name'])) : ?>
                        <?= $errors['name']; ?>
                <?php endif; ?>
            </label>
        </li>

        <li>
            <label> Assign to:
                <select name="user_id">
                    <?php foreach ($users as $user): ?>
                        <?php if ($user->id == $invalidData['user_id']): ?>
                            <option value="<?= $user->id; ?>" selected><?= $user->name; ?></option>
                        <?php else: ?>
                            <option value="<?= $user->id; ?>"><?= $user->name; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <?php if(isset($errors['user'])) : ?>
                        <?= $errors['user']; ?>
                    <?php endif; ?>
                </select>
            </label>
        </li>

        <li>
            <label> Status:
                <select name="status_id">
                    <?php foreach ($statuses as $status): ?>
                        <?php if ($status->id == $invalidData['status_id']): ?>
                            <option value="<?= $status->id; ?>" selected><?= $status->name; ?></option>
                        <?php else: ?>
                            <option value="<?= $status->id; ?>"><?= $status->name; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <?php if(isset($errors['status'])) : ?>
                            <?= $errors['status']; ?>
                    <?php endif; ?>
                </select>
            </label>
        </li>

        <li>
            <label> Priority:
                <select name="priority_id">
                    <?php foreach ($priorities as $priority): ?>
                        <?php if ($priority->id == $invalidData['priority_id']): ?>
                            <option value="<?= $priority->id; ?>" selected> <?= $priority->name; ?> </option>
                        <?php else: ?>
                            <option value="<?= $priority->id; ?>"> <?= $priority->name; ?> </option>
                        <?php endif; ?>
                    <?php endforeach; ?>

                        <?php if(isset($errors['priority'])) : ?>
                            <?= $errors['priority']; ?>
                        <?php endif; ?>
                    </select>
            </label>
        </li>

        <button type="submit">Submit</button>

    </form>

<?php require('partials/footer.php'); ?>