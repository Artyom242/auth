
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="max-width: 700px; margin: 0 auto">

    <?php
    /**@var PDO $db */
    $db = require_once $_SERVER['DOCUMENT_ROOT'] . '/db.php';

    $user = null;

    if (check_auth()) {
        // Получим данные пользователя по сохранённому идентификатору
        $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
        $stmt->execute(['id' => $_SESSION['user_id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>
    <?php if ($user): ?>
        <h1>Welcome back, <?=htmlspecialchars($user['username'])?>!</h1>
        <form class="mt-5" method="post" action="do_logout.php">
            <button type="submit" class="btn btn-primary">Logout</button>
        </form>
    <?php else: ?>

<h1 class="mb-5">Registration</h1>

    <?php if (hasFlash($_SESSION['flash'])): ?>
            <div class="alert alert-danger mb-3">
                <?=($_SESSION['flash']);?>
            </div>
        <?php unset($_SESSION['flash']);?>
    <?php endif; ?>

    <form method="post" action="do_register.php">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <a  href="/auth/form/login.php" class="btn btn-primary">Войти</a>
    </form>
    <?php endif; ?>
</body>
</html>