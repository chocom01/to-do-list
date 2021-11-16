<?php require('partials/head.php'); ?>

    <title> Task </title>

    <style>
        <?php include '../public/css/createTask.css'; ?>
    </style>

    <div class="center">
        <h2>Edit tasks</h2>
        <form method="POST" action="updateTask">

            <label> Assign to
                <select name="user_id">
                    <?php foreach ($associatedData['users'] as $user) : ?>
                        <?php if ($user->id == $task->user_id) : ?>
                            <option selected value="<?= $user->id; ?>"><?= $user->name; ?></option>
                        <?php else : ?>
                            <option value="<?= $user->id; ?>"><?= $user->name; ?></option>
                        <?php endif; ?>

                        <?php if (isset($errors['user'])) : ?>
                            <?= $errors['user']; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </label>

            <label> Status
                <select name="status_id">
                    <?php foreach ($associatedData['statuses'] as $status) : ?>
                        <?php if ($status->id == $task->status_id) : ?>
                            <option selected value="<?= $status->id; ?>"><?= $status->name; ?></option>
                        <?php else : ?>
                            <option value="<?= $status->id; ?>"><?= $status->name; ?></option>
                        <?php endif; ?>

                        <?php if (isset($errors['status'])) : ?>
                            <?= $errors['status']; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </label>

            <label> Priority
                <select name="priority_id">
                    <?php foreach ($associatedData['priorities'] as $priority) : ?>
                        <?php if ($priority->id == $task->priority_id) : ?>
                            <option selected value="<?= $priority->id; ?>"><?= $priority->name; ?></option>
                        <?php else : ?>
                            <option value="<?= $priority->id; ?>"><?= $priority->name; ?></option>
                        <?php endif; ?>

                        <?php if (isset($errors['priority'])) : ?>
                            <?= $errors['priority']; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </label>

            <label>
                <input name="id" type="hidden" value=<?=$task->id;?> />
                <input name="name" value="<?=$task->name;?>" type="text" placeholder="Your task name..">

                <?php if (isset($errors['name'])) : ?>
                    <?= $errors['name']; ?>
                <?php endif; ?>
            </label>

            <input type="submit" value="Update">
            <input type="submit" value="Delete" formaction="deleteTask">
        </form>
    </div>

<?php require('partials/footer.php'); ?>