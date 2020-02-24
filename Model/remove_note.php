<?php
session_start();
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/../urls.php');

$post_id = $_POST['id'];
$ses_id = $_POST['ses_id'];

if ($ses_id == session_id()) {

    $connection = @new mysqli($db_host, $db_login, $db_password, $db_name);

    if ($connection->connect_errno != 0) {
        echo "Error: " . $connection->connect_errno;
    } else {
        $query = "DELETE FROM notes WHERE notes.id ='$post_id';";
        if ($res = @$connection->query($query)) {
        }
    }
}
