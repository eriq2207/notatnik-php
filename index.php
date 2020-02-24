<?php
require_once('config.php');
require_once('urls.php');
session_start();
$cookie = $_COOKIE['notepad_user'];
$connection = @new mysqli($db_host, $db_login, $db_password, $db_name);
if (isset($cookie)) {
	if ($connection->connect_errno != 0) {
		echo "Error: " . $connection->connect_errno;
	} else {
		$query = "SELECT * FROM users WHERE cookie='$cookie'";
		if ($result = @$connection->query($query)) {
			$res_length = $result->num_rows;
			if ($res_length == 1) {
				$user = $result->fetch_assoc();
				$_SESSION['notepad_user'] = $user['username'];
				$_SESSION['user_id'] = $user['id'];
			}
			$result->free_result();;
		}
		$connection->close();
	}
}
if (isset($_SESSION['notepad_user']))
	header("Location:" . $notes_public_url);
else
	header("Location:" . $login_url);
