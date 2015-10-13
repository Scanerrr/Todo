<?php

session_start();

$_SESSION['user_id'] = 1;

//Connecting to DB
try {
    $db = new PDO('mysql:host=localhost;dbname=todo_list', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
    echo $e->getMessage();
    die();
}

//If user log out
if (!isset($_SESSION['user_id'])) {
    die("User isn't login");
}
