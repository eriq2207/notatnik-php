<?php
require_once(__DIR__.'/../config.php');
require_once(__DIR__.'/../urls.php');
session_start();

$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$corr_password = $_POST['corr_password'];

if(strlen($login)<6 || strlen($password)<6)
{
    $_SESSION['register_info'] = "Nazwa użytkownika i hasło powinno zawierać conajmniej 6 znaków!";
    header('Location:'.$register_url);
    exit();
}
if($password !== $corr_password)
{
    $_SESSION['register_info'] = "Podane hasła nie są identyczne!";
    header('Location:'.$register_url);
    exit();
}

$connection = @new mysqli($db_host, $db_login, $db_password, $db_name);

	if ($connection->connect_errno != 0) {
		echo "Error: ". $connection->connect_errno;
	} else {
        $query = "SELECT * FROM users WHERE username='$login'";
        if($res = @$connection->query($query))
            if($res->num_rows>0)
            {
                $_SESSION['register_info'] = "Istnieje już użytkownik o takim loginie!";
                $connection->close();
                header('Location:'.$register_url);
                exit();
            }
        $query = "SELECT * FROM users WHERE email='$email'";
        if($res = @$connection->query($query))
            if($res->num_rows>0)
            {
                $_SESSION['register_info'] = "Istnieje już użytkownik o takim adresie email!";
                header('Location:'.$register_url);
                $connection->close();
                exit();
            }
        $password_hash = hash("md5",$password);
        $query = "INSERT INTO users (id, username, password, email, cookie) VALUES (NULL, '$login', '$password_hash', '$email', '')";
        if($res = @$connection->query($query))
        {
            $_SESSION['register_info'] = "Udało się poprawnie zarejestrować!";
            $connection->close();
            header('Location:'.$register_url);
        }
    }
