<?php
session_start();
require "functions.php";

$email = "Muslim1@example.com";
$password = "secret";

$pdo = new PDO("mysql:host=localhost;dbname=my_project", "root", "" );

$sql = "SELECT * FROM users WHERE email=:email";
$statement = $pdo->prepare($sql);
$statement->execute(["email" => $email]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

if(!empty($user)){
    $_SESSION["danger"] = "Этот элекстронный адрес уже занят lheubv gjkmpjdfntktv";
    header("Location:/page_register.php");
    exit;
}



$sql = "INSERT INTO users(email, password) VALUES (:email, :password)";
$statement = $pdo->prepare($sql);
$statement->execute(
    [
        "email" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT)
    ]);

$_SESSION["success"] = "Регистрация прошла успешно";
header("Location:/page_login.php");
exit;



/*

$email = "Muslim@example.com";        //$_POST["email"];
$password = "123";                     //$_POST["password"];

$user = get_user_by_email($email);

if (!empty($user)) {
    set_flash_message("danger", "Этот электронный адрес уже занят другим пользователем"); //flesh_message
    redirect_to("page_register.php");
}

add_user($email, $password);

set_flash_message("success", "Рeгистрация успешна");

redirect_to("/page_login.php");
*/