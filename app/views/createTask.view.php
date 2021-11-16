<?php require('partials/head.php'); ?>

    <title>Create task</title>

    <style>
        <?php include '../public/css/createTask.css'; ?>
    </style>

    <div class="center">
        <h3>Create task</h3>
        <form method="POST" action="createTask">
            <label>Name
                <input name="name" value="<?=$invalidData->task_name;?>" type="text" placeholder="Your task name..">

                <?php if (isset($errors['name'])) : ?>
                    <?= $errors['name']; ?>
                <?php endif; ?>
            </label>

            <label>Assign to
                <select name="user_id">
                    <?php foreach ($associatedData['users'] as $user) : ?>
                        <?php if ($user->id == $invalidData->user_id) : ?>
                            <option selected value="<?= $user->id; ?>"><?= $user->name; ?></option>
                        <?php else : ?>
                            <option value="<?= $user->id; ?>"><?= $user->name; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <?php if (isset($errors['user'])) : ?>
                        <?= $errors['user']; ?>
                    <?php endif; ?>
                </select>
            </label>

            <label> Status
                <select name="status_id">
                    <?php foreach ($associatedData['statuses'] as $status) : ?>
                        <?php if ($status->id == $invalidData->status_id) : ?>
                            <option selected value="<?= $status->id; ?>"><?= $status->name; ?></option>
                        <?php else : ?>
                            <option value="<?= $status->id; ?>"><?= $status->name; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <?php if (isset($errors['status'])) : ?>
                        <?= $errors['status']; ?>
                    <?php endif; ?>
                </select>
            </label>


            <label>Priority
                <select name="priority_id">
                    <?php foreach ($associatedData['priorities'] as $priority) : ?>
                        <?php if ($priority->id == $invalidData->priority_id) : ?>
                            <option selected value="<?= $priority->id; ?>"> <?= $priority->name; ?> </option>
                        <?php else : ?>
                            <option value="<?= $priority->id; ?>"> <?= $priority->name; ?> </option>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <?php if (isset($errors['priority'])) : ?>
                        <?= $errors['priority']; ?>
                    <?php endif; ?>
                </select>
            </label>

            <input type="submit" value="Submit">
        </form>
    </div>
<?php require('partials/footer.php'); ?>