<?php
session_start();
require_once(__DIR__.'/../config.php');
require_once(__DIR__.'/../urls.php');

$title = $_POST['title'];
$text = $_POST['text'];
if(isset($_POST['private']))
	$private = 1;
else
	$private = 0;

echo $private;
echo $title;
echo $text;
echo $_SESSION['user_id'];
$connection = @new mysqli($db_host, $db_login, $db_password, $db_name);
    if ($connection->connect_errno != 0) {
		echo "Error: ". $connection->connect_errno;
    } else {
        $user_id = $_SESSION['user_id'];
        $query = "INSERT INTO notes (id, tittle, text, user_id, private) VALUES (NULL,'".$title."', '".$text."', '".$user_id."', '".$private."');";
		echo $query;
        if($res = @$connection->query($query))
        {
			$_SESSION['insert_error'] = 0;
		}
		else
			$_SESSION['insert_error'] = 1;
			echo "Nie udalo sie dodac notatki";
		}
	$connection->close();
	if($private==0)
		header('Location:'.$notes_public_url);
	else
		header('Location:'.$notes_private_url);
