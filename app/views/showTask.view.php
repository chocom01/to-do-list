<?php require('partials/head.php'); ?>

    <h2>Edit tasks</h2>

<?php foreach ($_SESSION['task'] as $task): ?>

    <form method="POST" action="updateTask">

        <strong>Title:</strong> <?= $task->name; ?>

        <label> <strong>Assign to:</strong>
            <select name="user_id">

                <?php foreach ($_SESSION['users'] as $user): ?>

                    <?php if($user->id == $task->user_id) : ?>
                        <option selected value="<?= $user->id; ?>"><?= $user->name; ?></option>
                    <?php elseif ($user->id == $_SESSION['invalidData']['user_id']): ?>
                        <option selected value="<?= $_SESSION['invalidData']['user_id']; ?>"><?= $user->name; ?></option>
                    <?php else: ?>
                        <option value="<?= $user->id; ?>"><?= $user->name; ?></option>
                    <?php endif; ?>

                    <?php if(isset($_SESSION['errors']['user'])) : ?>
                        <?= $_SESSION['errors']['user']; ?>
                    <?php endif; ?>

                <?php endforeach; ?>
            </select>
        </label>

        <label> <strong>Status:</strong>

            <select name="status_id">

                <?php foreach ($_SESSION['statuses'] as $status): ?>

                    <?php if($status->id == $task->status_id) : ?>
                        <option selected value="<?= $status->id; ?>"><?= $status->name; ?></option>
                    <?php elseif ($status->id == $_SESSION['invalidData']['status_id']): ?>
                        <option selected value="<?= $_SESSION['invalidData']['status_id']; ?>"><?= $status->name; ?></option>
                    <?php else: ?>
                        <option value="<?= $status->id; ?>"><?= $status->name; ?></option>
                    <?php endif; ?>

                    <?php if(isset($_SESSION['errors']['status'])) : ?>
                        <?= $_SESSION['errors']['status']; ?>
                    <?php endif; ?>

                <?php endforeach; ?>

            </select>
        </label>

        <label> <strong>Priority:</strong>

            <select name="priority_id">

                <?php foreach ($_SESSION['priorities'] as $priority): ?>

                    <?php if($priority->id == $task->priority_id) : ?>
                        <option selected value="<?= $priority->id; ?>"><?= $priority->name; ?></option>
                    <?php elseif ($priority->id == $_SESSION['invalidData']['priority_id']): ?>
                        <option selected value="<?= $_SESSION['invalidData']['priority_id']; ?>"><?= $priority->name; ?></option>
                    <?php else: ?>
                        <option value="<?= $priority->id; ?>"><?= $priority->name; ?></option>
                    <?php endif; ?>

                    <?php if(isset($_SESSION['errors']['priority'])) : ?>
                        <?= $_SESSION['errors']['priority']; ?>
                    <?php endif; ?>

                <?php endforeach; ?>

            </select>
        </label>

        <label>

            <input name="id" type="hidden" value=<?=$task->id;?> />

            <?php if(isset($_SESSION['invalidData']['task_name'])) : ?>
                <input name="task_name" value="<?=$_SESSION['invalidData']['task_name'];?>">
            <?php else: ?>
                <input name="task_name" value="<?=$task->name;?>">
            <?php endif; ?>

            <?php if(isset($_SESSION['errors']['name'])) : ?>
                <?= $_SESSION['errors']['name']; ?>
            <?php endif; ?>

        </label>

        <button type="submit" >Update</button>

        <button type="submit" formaction="deleteTask" >Delete</button>
    </form>

<?php endforeach; ?>

<?php require('partials/footer.php'); ?>