<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/db.php';

// Проверим, не занято ли имя пользователя
$stmt = pdo()->prepare("SELECT * FROM `users` WHERE `username` = :username");
$stmt->execute(['username' => $_POST['username']]);
if ($stmt->rowCount() > 0) {
    setFlash('username-error','Это имя пользователя уже занято' );
    header('Location:  /auth/form/index.php'); // Возврат на форму регистрации
    die; // Остановка выполнения скрипта
}

if (mb_strlen($_POST['password'], "UTF-8")<3){
    setFlash('password-error','Длина пароля менее 6 символов' );
    header('Location:  /auth/form/index.php'); // Возврат на форму регистрации
    die; // Остановка выполнения скрипта
}

// Добавим пользователя в базу
$stmt = pdo()->prepare("INSERT INTO `users` (`username`, `password`) VALUES (:username, :password)");
$stmt->execute([
    'username' => $_POST['username'],
    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
]);

header('Location: /auth/form/login.php');