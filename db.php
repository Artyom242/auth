<?php
session_start();

function pdo(): PDO
{
    static $pdo;

    if (!$pdo) {
        // Подключение к БД
        $dsn = 'mysql:host=localhost;dbname=auth_test';
        $pdo = new PDO($dsn, "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    return $pdo;
}

function flash(?string $message = null)
{
    if ($message) {
        $_SESSION['flash'] = $message;
    } else {
        if (!empty($_SESSION['flash'])) { ?>
            <div class="alert alert-danger mb-3">
                <?=$_SESSION['flash']?>
            </div>
        <?php }
        unset($_SESSION['flash']);
    }
}

function check_auth(): bool
{
    return isset($_SESSION['user_id']);
}







function setFlash(string $message, string $value): void
{
    if($message){
        $_SESSION['flash'] = $value;
    } else{
        $_SESSION['flash'] = null;
    }
}

function getFlash(string $message, bool $delete = true): string | null
{
    return $_SESSION['flash'];
}

function hasFlash(string $message): bool
{
    if(!empty($message)){
        return true;
    }else return false;
}

setFlash('password-error', 'Длина пароля менее 6 символов');
