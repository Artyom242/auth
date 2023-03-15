<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/db.php';

// проверяем наличие пользователя с указанным юзернеймом
$stmt = pdo()->prepare("SELECT * FROM `users` WHERE `username` = :username");
$stmt->execute(['username' => $_POST['username']]);
if (!$stmt->rowCount()) {
    setFlash('login-error','Пользователь с такими данными не зарегистрирован');
    header('Location: /auth/form/login.php');
    die;
}
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// проверяем пароль
if (password_verify($_POST['password'], $user['password'])) {
    if (password_needs_rehash($user['password'], PASSWORD_DEFAULT)) {
        $newHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = pdo()->prepare('UPDATE `users` SET `password` = :password WHERE `username` = :username');
        $stmt->execute([
            'username' => $_POST['username'],
            'password' => $newHash,
        ]);
    }
    $_SESSION['user_id'] = $user['id'];
    header('Location: /auth/form/index.php');
    die;
}

setFlash('passwordLogin-error', 'Пароль неверен');
header('Location: /auth/form/login.php');