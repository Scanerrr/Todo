<?php

require_once 'init.php';

if (isset($_GET['delete'])) {
    $del = $db->prepare("
        DELETE FROM lists
        WHERE id = :id
    ");

    $del->execute([
        'id' => $_GET['delete']
    ]);
}

if (isset($_GET['status'])) {
    if(!checker($db, $_GET['status'])) {
        $stat = $db->prepare("
            UPDATE lists
            SET status = 1
            WHERE id = :id
        ");
    }
    else {
        $stat = $db->prepare("
            UPDATE lists
            SET status = 0
            WHERE id = :id
        ");
    }
    $stat->execute([
        'id' => $_GET['status']
    ]);
}


//Check status
function checker($db, $id) {
    $id = intval($id);
    $sql = $db->query("
        SELECT status
        FROM lists
        WHERE id = $id
    ");

    $result = $sql->fetchAll();

    if(intval($result[0]['status']) == 0) {
        return 0;
    }
    else
        return 1;
}

header('Location: ../index.php');