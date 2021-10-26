<?php require('partials/head.php'); ?>

<h2>Tasks</h2>
    <?php foreach ($tasks as $task): ?>

        <strong>Name:</strong> <?= $task->taskName; ?>

         <strong>Assign to:</strong>

                <?php foreach ($_SESSION['users'] as $user): ?>

                    <?php if($user->id == $task->user_id) : ?>
                        <?= $user->name; ?>
                    <?php endif; ?>

                <?php endforeach; ?>

         <strong>Status:</strong>

                <?php foreach ($_SESSION['statuses'] as $status): ?>

                    <?php if($status->id == $task->status_id) : ?>
                        <?= $status->name; ?>
                    <?php endif; ?>

                <?php endforeach; ?>

         <strong>Priority:</strong>

                <?php foreach ($_SESSION['priorities'] as $priority): ?>

                    <?php if($priority->id == $task->priority_id) : ?>
                        <?= $priority->name; ?>
                    <?php endif; ?>

                <?php endforeach; ?>

            <input name="id" type="hidden" value=<?=$task->id;?> />

       <a href="task?id=<?=$task->id;?>">show</a>

    <br>

    <?php endforeach; ?>

<?php require('partials/footer.php'); ?>