<?php
  require_once(__DIR__.'/../config.php');
  require_once(__DIR__.'/../urls.php');
session_start();

$connection = @new mysqli($db_host, $db_login, $db_password, $db_name);
$user_id = $_SESSION['user_id'];
$query = "UPDATE users SET cookie = '' WHERE users.id = '$user_id'";
if($result = @$connection->query($query))
    setcookie("notepad_user", "", time()-360);

session_unset();

header("Location:".$login_url);
