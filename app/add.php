<?php

require_once 'init.php';

if (isset($_POST['text'])) {
    $text = trim($_POST['text']);

    if(!empty($text)) {
        $adding = $db->prepare("
            INSERT INTO lists (text, user, status, add_time)
            VALUES (:text, :user, 0, now())
        ");

        $adding->execute([
            'text' => $text,
            'user' => $_SESSION['user_id']
        ]);
    }
}

header('Location: ../index.php');