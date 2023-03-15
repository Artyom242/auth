<?php
/**@var PDO $db */
$db = require_once $_SERVER['DOCUMENT_ROOT'] . '/db.php';

$_SESSION['user_id'] = null;
header('Location: /auth/form/index.php');