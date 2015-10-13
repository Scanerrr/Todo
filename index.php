<?php

require_once 'app/init.php';

$listsQuerry = $db->prepare('
    SELECT id, text, status, add_time
    FROM lists
    WHERE user = :user
');

$listsQuerry->execute([
    'user' => $_SESSION['user_id']
]);
$lists = $listsQuerry->fetchAll();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List</title>
    <link rel="stylesheet" href="css/main.css">
    <script type="text/javascript" src="lib/jquery-2.1.4.min.js"></script>
</head>
<body>
<div class="main_place">
    <h1 class="header">Your list:</h1>
    <br>
    <?php if (empty($lists)) { ?>
        <p>No tasks here.</p>
    <?php } else { ?>
        <ul class="tasks">
            <?php foreach ($lists as $list): ?>
                <?php if ($list['status'] == 0):?>
                <li>
                    <input type="checkbox" class="done_btn checkbox" id="<?= $list['id']; ?>">
                    <label for="<?= $list['id']; ?>">
                        <?php echo $list['text']; ?>
                    <div class="delete"><a href="app/controller.php?delete=<?= $list['id']; ?>"></a></div>
                </li>
                    <?php endif;?>
            <?php endforeach; ?>
        </ul>
    <?php } ?>
    <br>
    <form action="app/add.php" method="post">
        <input type="text" placeholder="Type task here!" name="text" class="adding" autocomplete="off" required>
        <input type="submit" value="Add" class="add_btn">
    </form>
</div>
<div class="done_space">
    <h1 class="header">Done tasks:</h1>
    <br>
        <ul class="tasks">
            <?php foreach ($lists as $list): ?>
                <?php if ($list['status'] == 1): ?>
                    <li>
                        <input checked type="checkbox" class="done_btn checkbox" id="<?= $list['id']; ?>">
                        <label for="<?= $list['id']; ?>">
                            <?php echo $list['text']; ?>
                        </label>
                        <div class="delete"><a href="app/controller.php?delete=<?= $list['id']; ?>"></a></div>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
</div>
<script>
    $('input[type=checkbox]').click(function () {
        var id = $(this).attr('id');
        window.location = 'app/controller.php?status='+id;
    });
</script>
</body>
</html>
