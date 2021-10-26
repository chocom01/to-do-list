<?php require('partials/head.php'); ?>

<h2>Create task</h2>

    <form method="POST" action="createTask">
        <li>
            <label>Name
                <input name="task_name" value="<?=$_SESSION['invalidData']['task_name'];?>"/>

                <?php if(isset($_SESSION['errors']['name'])) : ?>
                        <?= $_SESSION['errors']['name']; ?>
                <?php endif; ?>

            </label>
        </li>

        <li>
            <label> Assign to:
                <select name="user_id">

                    <?php foreach ($_SESSION['users'] as $user): ?>

                        <?php if ($user->id == $_SESSION['invalidData']['user_id']): ?>
                            <option value="<?= $user->id; ?>" selected><?= $user->name; ?></option>
                        <?php else: ?>
                            <option value="<?= $user->id; ?>"><?= $user->name; ?></option>
                        <?php endif; ?>

                    <?php endforeach; ?>

                    <?php if(isset($_SESSION['errors']['user'])) : ?>
                        <?= $_SESSION['errors']['user']; ?>
                    <?php endif; ?>

                </select>
            </label>
        </li>

        <li>
            <label> Status:
                <select name="status_id">

                    <?php foreach ($_SESSION['statuses'] as $status): ?>

                        <?php if ($status->id == $_SESSION['invalidData']['status_id']): ?>
                            <option value="<?= $status->id; ?>" selected><?= $status->name; ?></option>
                        <?php else: ?>
                            <option value="<?= $status->id; ?>"><?= $status->name; ?></option>
                        <?php endif; ?>

                    <?php endforeach; ?>

                    <?php if(isset($_SESSION['errors']['status'])) : ?>
                            <?= $_SESSION['errors']['status']; ?>
                    <?php endif; ?>

                </select>
            </label>
        </li>

        <li>
            <label> Priority:
                <select name="priority_id">

                    <?php foreach ($_SESSION['priorities'] as $priority): ?>

                        <?php if ($priority->id == $_SESSION['invalidData']['priority_id']): ?>
                            <option value="<?= $priority->id; ?>" selected> <?= $priority->name; ?> </option>
                        <?php else: ?>
                            <option value="<?= $priority->id; ?>"> <?= $priority->name; ?> </option>
                        <?php endif; ?>

                    <?php endforeach; ?>

                        <?php if(isset($_SESSION['errors']['priority'])) : ?>
                            <?= $_SESSION['errors']['priority']; ?>
                        <?php endif; ?>

                    </select>
            </label>
        </li>

        <button type="submit">Submit</button>

    </form>

<?php require('partials/footer.php'); ?>