<?php
require_once 'connect.php';

function createDBConnection(): mysqli {
  
  $conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  //echo "Connected successfully<br>";
  return $conn;
}


function getAndPrintFeaturePostFromDB(mysqli $conn): void {
  $sql = "SELECT * FROM post WHERE featured = 1";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($post = $result->fetch_assoc()) {
        include 'feature-post-preview_adapt.php';
    }
  } else {
    echo "0 results";
  }
}

function getAndPrintMostRecentFromDB(mysqli $conn): void {
    $sql = "SELECT * FROM post WHERE featured = 0";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($post = $result->fetch_assoc()) {
          include 'most-recent-preview_adapt.php';
      }
    } else {
      echo "0 results";
    }
  }

function closeDBConnection(mysqli $conn): void {
  $conn->close();
}


$conn = createDBConnection();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Blog">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>
    <link rel="stylesheet" href="/static/style/home_adapt.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Oxygen:wght@300;400;700&display=swap"
        rel="stylesheet">
    <script defer src="/static/js/home.js"></script>
</head>

<body>
    
    <header class="header">
        <div class="top-bar">
            <img class="logo-escape" src="/static/img/logo-escape-white.svg" alt="logo Escape.">
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
        <h1 class="title">Let's do it together.</h1>
        <h6 class="under-title">We travel the world in search of stories. Come along for the ride.</h6>
        <a class="latest-post-link">View Latest Posts</a>
    </header>
    <main class="main">
        <nav class="main-navigation">
            <ul class="main-navigation__list">
                <li class="main-navigation__list-item">
                    <a class="main-navigation__link" href="#">Nature</a>
                </li>
                <li class="main-navigation__list-item">
                    <a class="main-navigation__link" href="#">Photography</a>
                </li>
                <li class="main-navigation__list-item">
                    <a class="main-navigation__link" href="#">Relaxation</a>
                </li>
                <li class="main-navigation__list-item">
                    <a class="main-navigation__link" href="#">Vacation</a>
                </li>
                <li class="main-navigation__list-item">
                    <a class="main-navigation__link" href="#">Travel</a>
                </li>
                <li class="main-navigation__list-item">
                    <a class="main-navigation__link" href="#">Adventure</a>
                </li>
            </ul>
        </nav>

        <div class="content">
            <div class="content__title">Featured Posts</div>
            <div class="underline"></div>
            <ul class="features-posts">                
                <?php getAndPrintFeaturePostFromDB($conn); ?>
            </ul>

            <div class="content__title">Most Recent</div>
            <div class="underline"></div>
            <ul class="most-recent">
                <?php getAndPrintMostRecentFromDB($conn); ?> 
            </ul>
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
</body>

</html>


<?php closeDBConnection($conn); ?>