<?php
function authBySession()
{
    session_name('auth');
    session_start();
    $userId = $_SESSION['user_id'] ?? null;
    //echo "userId: $userId;";
    if ($userId !== null) {
        header("Location: /admin2.php", TRUE, 301);
    }
}
    authBySession();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="LW_1">
    <title>
        LW_1
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/static/style/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Oxygen:wght@300;400;700&display=swap"
          rel="stylesheet">
    <script defer src="/static/js/login.js"></script>
</head>
<body>

<header class="header">
</header>

<main class="main">
    <div class="logo-block">
        <img class="logo-block__logo" src="/static/img/escape_authors_logo.svg" alt="escape authors logo">
        <div class="logo-block__description">Log in to start creating</div>
    </div>
    <div class="login-block">
        <h1 class="login-block__title">Log In</h1>
        
        <div class="critical hidden">
            <img class="critical__image hidden" src="/static/img/alert-circle.svg" alt="alert circle">
            <p class="critical__description hidden">Please, enter correct values.</p>
        </div>       
        
        <label for="" class="login-block__label-form">Email</label>
        <div class="login-block__form-item-block">
            <input id="form-email" type="text" class="login-block__input-text" maxlength="255" placeholder=" ">
            <p id="input-email-critical" class="login-block__input-text-critical hidden">Email is required.</p>
        </div>

        <label for="" class="login-block__label-form">Password</label>
        <div class="login-block__form-item-block">
            <input id="form-password" type="text" class="login-block__input-text" maxlength="255" placeholder=" ">
            <p id="input-password-critical" class="login-block__input-text-critical hidden">Password is required.</p>
        </div>
        <button class="login-block__login-button">Log In</button>
    </div>
</main>



<footer>

</footer>

</body>
</html>
