<?php
session_start();
function get_user_by_email($email)
{
    $pdo = new PDO("mysql:host=localhost; dbname=my_project", "root", "");

    $sql = "SELECT * FROM users WHERE email=:email";

    $statement = $pdo->prepare($sql);
    $statement->execute(["email" => $email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function set_flash_message($name, $message)
{
    $_SESSION[$name] = $message;
}

function redirect_to($path)
{
    header("Location: {$path}");
    exit;
}

function add_user($email, $password)
{
    $pdo = new PDO("mysql:host=localhost; dbname=my_project", "root", "");
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";

    $statement = $pdo->prepare($sql);
    $statement->execute(
        [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

    return $pdo->lastInsertId();
}

function display_flesh_message($name)
{
    if (isset($_SESSION[$name])) {

        echo "<div class=\" alert alert-{name} text-dark\" role=\"alert\">{$_SESSION[$name]}</div>";
        unset($_SESSION[$name]);
    }
}