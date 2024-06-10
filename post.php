<?php
$id = $_GET['id'];

require_once 'connect.php';
function createDBConnection(): mysqli {
  
    $conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
  
    //echo "Connected successfully<br>";
    return $conn;
  }
  
  function getAndPrintPostFromDB(mysqli $conn): void {
    global $id, $post;
    if (!ctype_digit($id))
    {
        header("Location: home");
    }
    $sql = "SELECT * FROM post WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows != 1)
    {
        header("Location: home");
    }
    $post = $result->fetch_assoc();
  }
  
  function closeDBConnection(mysqli $conn): void {
    $conn->close();
  }
  
  $conn = createDBConnection();
  getAndPrintPostFromDB($conn);
  closeDBConnection($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The road ahead">
    <script defer src="/static/js/home.js"></script>
    <title>
        <?= $post['title'] ?>
    </title>
    <link rel="stylesheet" href="/static/style/post.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Oxygen:wght@300;400;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <header class="header">
    <div class="top-bar">
            <img class="logo-escape" src="/static/img/logo-escape-black.svg" alt="logo Escape.">
            <nav class="navigation">
                <ul class="navigation__list">
                    <li class="navigation__list-item">
                        <a class="navigation__link" href="./home">Home</a>
                    </li>
                    <li class="navigation__list-item">
                        <a class="navigation__link" href="#">Categories</a>
                    </li>
                    <li class="navigation__list-item">
                        <a class="navigation__link" href="#">About</a>
                    </li>
                    <li class="navigation__list-item">
                        <a class="navigation__link" href="#">Contact</a>
                    </li>
                </ul>
            </nav>
            <div class="burger-menu-button">
                <div class="burger-menu-button__line"></div>
                <div class="burger-menu-button__line"></div>
                <div class="burger-menu-button__line"></div>
            </div>
            
        </div>
        <nav class="burger-navigation">
            <ul class="burger-navigation__list">
                <li class="burger-navigation__list-item">
                    <a class="burger-navigation__link" href="./home">Home</a>
                </li>
                <li class="burger-navigation__list-item">
                    <a class="burger-navigation__link" href="#">Categories</a>
                </li>
                <li class="burger-navigation__list-item">
                    <a class="burger-navigation__link" href="#">About</a>
                </li>
                <li class="burger-navigation__list-item">
                    <a class="burger-navigation__link" href="#">Contact</a>
                </li>
            </ul>
        </nav>



        <!-- <img class="logo" src="/static/img/logo-escape-black.svg" alt="logo Escape">
        <nav class="navigation">
            <ul class="navigation__list">
                <li class="navigation__list-item">
                    <a class="navigation__link" href="/home">Home</a>
                </li>
                <li class="navigation__list-item">
                    <a class="navigation__link" href="#">Categories</a>
                </li>
                <li class="navigation__list-item">
                    <a class="navigation__link" href="#">About</a>
                </li>
                <li class="navigation__list-item">
                    <a class="navigation__link" href="#">Contact</a>
                </li>
            </ul>
        </nav> -->
    </header>
    <main class="main">
        <h1 class="title"><?= $post['title'] ?></h1>
        <h6 class="under-title"><?= $post['subtitle'] ?></h6>
        <img class="image" src="/static/img/<?= $post['image_url'] ?>" alt="<?= $post['title'] ?>">
        <div class="content">
            <p class="content__text">
                <?= $post['content'] ?>
            </p>
        </div>
    </main>


    <footer class="footer">
        <div class="bottom-bar">
            <img class="logo-escape" src="/static/img/logo-escape-white.svg" alt="logo Escape.">
            <nav class="navigation footer-nav">
                <ul class="navigation__list">
                    <li class="navigation__list-item">
                        <a class="navigation__link navigation__link_padding" href="./home">Home</a>
                    </li>
                    <li class="navigation__list-item">
                        <a class="navigation__link navigation__link_padding" href="#">Categories</a>
                    </li>
                    <li class="navigation__list-item">
                        <a class="navigation__link navigation__link_padding" href="#">About</a>
                    </li>
                    <li class="navigation__list-item">
                        <a class="navigation__link navigation__link_padding" href="#">Contact</a>
                    </li>
                </ul>
            </nav>
        </div>
    </footer>

    <!-- <footer class="footer">
        <div class="container">
            <img class="logo" src="/static/img/logo-escape-white.svg" alt="logo Escape">
            <nav class="navigation">
                <ul class="navigation__list">
                    <li class="navigation__list-item">
                        <a class="navigation__link navigation__link_padding-color" href="./home">Home</a>
                    </li>
                    <li class="navigation__list-item">
                        <a class="navigation__link navigation__link_padding-color" href="#">Categories</a>
                    </li>
                    <li class="navigation__list-item">
                        <a class="navigation__link navigation__link_padding-color" href="#">About</a>
                    </li>
                    <li class="navigation__list-item">
                        <a class="navigation__link navigation__link_padding-color" href="#">Contact</a>
                    </li>
                </ul>
            </nav>
        </div>
    </footer> -->
</body>

</html>