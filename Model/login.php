<?php
require_once(__DIR__.'/../config.php');
require_once(__DIR__.'/../urls.php');
session_start();
if (isset($_SESSION['notepad_user']))
{
    header("Location:".$notes_public_url);
    exit();
}
$connection = @new mysqli($db_host, $db_login, $db_password, $db_name);

	if ($connection->connect_errno != 0) {
		echo "Error: ". $connection->connect_errno;
	} else {
        $login = $_POST['user'];
        $password = $_POST['password'];
        $remember = $_POST['remember'];
        $password_hash = hash("md5",$password);
		$query = "SELECT * FROM users WHERE email='$login' OR username='$login'";
		if($result = @$connection->query($query))
		{
			$res_length = $result->num_rows;
			if($res_length==1)
			{
                $user = $result->fetch_assoc();
                $result->free_result();
                $password_equal = hash_equals($user['password'],$password_hash);
                if($password_equal)
                {
                    $_SESSION['notepad_user'] = $user['username'];
                    $_SESSION['user_id'] = $user['id'];
                    if($remember=='on')
                    {
                        $random = random_bytes (16);
                        $hash_cookie = hash("md5",$random);
                        $user_id = $_SESSION['user_id'];
                        $query = "UPDATE users SET cookie = '$hash_cookie' WHERE users.id = '$user_id'";
                        if($result = @$connection->query($query))
                            setrawcookie("notepad_user", $hash_cookie, time()+86400, "/");
                    }
                }
			}
		}
		$connection->close();
	}

if (isset($_SESSION['notepad_user']))
{
    header("Location:".$notes_public_url);
}
else
{
    header("Location:".$login_url);
    $_SESSION['login_error']="Zła nazwa użytkownika lub hasło";
}
