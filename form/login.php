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
<body style="max-width: 600px; margin: 0 auto">
    <h1 class="mb-5">Login</h1>

    <?php
    /**@var PDO $db */
    $db = require_once $_SERVER['DOCUMENT_ROOT'] . '/db.php';

    if (check_auth()) {
        header('Location: /');
        die;
    }

    if (hasFlash($_SESSION['flash'])): ?>
        <div class="alert alert-danger mb-3">
            <?=getFlash($_SESSION['flash']);?>
        </div>
        <?php unset($_SESSION['flash']);?>
    <?php endif; ?>
    <!-- Далее форма логина -->

    <form method="post" action="do_login.php">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Login</button>
            <a class="btn btn-outline-primary" href="index.php">Register</a>
        </div>
    </form>
</body>
</html>