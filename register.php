<?php
session_start();
require "functions.php";

$email = $_POST["email"];
$password =$_POST["password"];

$user = get_user_by_email($email);

if (!empty($user)) {
    set_flash_message("danger", "Этот электронный адрес уже занят другим пользователем"); //flesh_message
    redirect_to("page_register.php");
}

add_user($email, $password);

set_flash_message("success", "Рeгистрация успешна");

redirect_to("/page_login.php");
