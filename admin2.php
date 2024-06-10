<?php
    require_once 'connect.php';
    function createDBConnection(): mysqli { 
        $conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
        if ($conn->connect_error) {
        header("Location: /login.php", TRUE, 503);
        die("Connection failed: " . $conn->connect_error);
        }
    
        //echo "Connected successfully\n";
        return $conn;
    }
  
    function searchUserFromDB(mysqli $conn, string $userId): array {
        $sql = "SELECT * FROM user WHERE user_id = '$userId'";
        $result = $conn->query($sql);
        $user = [];
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
        } else {
            echo "0 results";
        }
        return $user;
    }
  
    function closeDBConnection(mysqli $conn): void {
        $conn->close();
    }
    function authBySession(): void {
        global $user;
        session_name('auth');
        session_start();
        $userId = $_SESSION['user_id'] ?? null;
        if ($userId === null){
            header("Location: /login.php", TRUE, 301);
        }
        $conn = createDBConnection();
        $user = searchUserFromDB($conn, $userId);
        closeDBConnection($conn);
    }
authBySession();
    //echo "userId: $userId;";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="LW_1">
    <title>
        LW_1
    </title>
    <link rel="stylesheet" href="/static/style/admin2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Oxygen:wght@300;400;700&display=swap"
          rel="stylesheet">
    <script defer src="/static/js/admin.js"></script>
</head>
<body>

<header class="header">
    <div class="menu container">
        <img class="logo" src="/static/img/Logo.svg" alt="Logo Escape.author"/>
        <menu class="account-menu">
            <div class="account-menu__author-icon" style="background-color: #<?= substr(md5($user['email']), 0,6)?>;"><?= $user['email'][0]?></div>
            <button class="account-menu__log-out-button"><img class="log-out-image" src="/static/img/log-out.svg" alt="log out"></button>
        </menu>
    </div>
</header>

<main class="main">
    <div class="publish-block container">
        <div>
            <h1 class="publish-block__title">New Post</h1>
            <div class="publish-block__description">Fill out the form bellow and publish your article</div>
        </div>
        <button class="publish-block__publish-button">Publish</button>
    </div>
    
    <div class="critical container">
        <img class="critical__image" src="/static/img/alert-circle.svg" alt="alert circle">
        <p class="critical__description">Whoops! Some fields need your attention :o</p>
    </div>

    <div class="success container">
        <img class="success__image" src="/static/img/check-circle.svg" alt="check circle">
        <p class="success__description">Publish Complete!</p>
    </div>

    <h2 class="main-info__title container">Main Information</h2>
    <div class="main-info container">
        <div class="main-info__form">
            <label for="" class="main-info__label-form">Title</label>
            <div class="main-info__form-item-block">
                <input id="form-title" type="text" class="main-info__input-text" maxlength="255" placeholder=" ">
                <p id="input-title-critical" class="main-info__input-text-critical">Title post is required.</p>
            </div>

            <label for="" class="main-info__label-form">Description</label>
            <div class="main-info__form-item-block">
                <input id="form-description" type="text" class="main-info__input-text" maxlength="255" placeholder=" ">
                <p id="input-description-critical" class="main-info__input-text-critical">Description is required.</p>
            </div>

            <label for="" class="main-info__label-form">Author name</label>
            <div class="main-info__form-item-block">
                <input id="form-author-name" type="text" class="main-info__input-text" maxlength="255" placeholder=" ">
                <p id="input-author-name-critical" class="main-info__input-text-critical">Author name is required.</p>
            </div>
            
            <label for="" class="main-info__label-form">Author photo</label>
            <div class="main-info__author-block">
                <label for="load-author-photo" class="main-info__post-author-photo">
                    <img id="preview-author-photo" src="/static/img/Avatar.svg" alt="Выберите файл" class="main-info__preview-author-photo">
                    <input id="load-author-photo" type="file" class="main-info__input-author-photo" accept="image/png, image/jpeg, image/gif">
                </label>
                
                <label id="button-author-photo-upload" class="button-upload" for="load-author-photo" style="margin-bottom: 0">
                    <img class="upload-icon" src="/static/img/camera.svg" alt="camera icon">
                    <span class="button-upload-text">Upload New</span>
                </label>
                <label id="button-author-photo-trash" class="button-trash" for="" style="margin-bottom: 0">
                    <img class="trash-icon" src="/static/img/trash.svg" alt="trash">
                    <span class="button-trash-text">Remove</span>
                </label>
                <label id="author-photo__text" class="main-info__author-text" style="display: inline-block; margin: auto 0;">Upload</label>
            </div>

            
            <label for="" class="main-info__label-form">Publish date</label>
            <div class="main-info__form-item-block">
                <input id="form-publish-date" type="date" class="main-info__input-text">
                <p id="input-publish-date-critical" class="main-info__input-text-critical">Publish date is required.</p>
            </div>

            <label for="" class="main-info__label-form">Hero image</label>
            <div class="main-info__image-block">
                <label for="load-main-image" class="main-info__post-image">
                    <img id="preview-main-image" src="/static/img/UploadImage.svg" alt="Выберите файл" class="main-info__preview-image">
                    <input id="load-main-image" type="file" class="main-info__input-image" accept="image/png, image/jpeg, image/gif">
                </label>
            </div>
            <label id="button-main-image-upload" class="button-upload" for="load-main-image">
                <img class="upload-icon" src="/static/img/camera.svg" alt="camera icon">
                <span class="button-upload-text">Upload New</span>
            </label>
            <label id="button-main-image-trash" class="button-trash" for="">
                <img class="trash-icon" src="/static/img/trash.svg" alt="trash">
                <span class="button-trash-text">Remove</span>
            </label>
            <p id="main-image__size-format-data" class="main-info__size-format-data">Size up to 10mb. Format: png, jpeg, gif.</p>
            
            <label for="" class="main-info__label-form">Hero image</label>
            <div class="main-info__card-image-block">
                <label for="load-card-image" class="main-info__post-card-image">
                    <img id="preview-card-image" src="/static/img/UploadCardImage.svg" alt="Выберите файл" class="main-info__preview-card-image">
                    <input id="load-card-image" type="file" class="main-info__input-card-image" accept="image/png, image/jpeg, image/gif">
                </label>
            </div>
            <label id="button-card-image-upload" class="button-upload" for="load-card-image">
                <img class="upload-icon" src="/static/img/camera.svg" alt="camera icon">
                <span class="button-upload-text">Upload New</span>
            </label>
            <label id="button-card-image-trash" class="button-trash" for="">
                <img class="trash-icon" src="/static/img/trash.svg" alt="trash">
                <span class="button-trash-text">Remove</span>
            </label>
            <p id="card-image__size-format-data" class="main-info__size-format-data">Size up to 10mb. Format: png, jpeg, gif.</p>
        </div>
        
        
        
        <div class="preview">
            <h2 class="preview__title">Article preview</h2>
            <div class="preview__article">
                <div class="preview__article-block">
                    <div class="preview__article-header">
                        <div class="circle"></div>
                        <div class="circle"></div>
                        <div class="circle"></div>
                    </div>
                    <h2 id="article-preview-title" class="preview__article-title">New Post</h2>
                    <p id="article-preview-description" class="preview__article-description">Please, enter any description</p>
                    <div class="preview__article-image-block">
                        <img id="article-preview-main-image" class="preview__article-image" src="#" alt="article image">
                    </div>
                </div>
                <div class="blend-right"></div>
                <div class="blend-bottom"></div>
            </div>

            <h2 class="preview__title">Post card preview</h2>
            <div class="preview__card">
                <div class="preview__card-block">
                    <div class="preview__card-image-block">
                        <img id="card-preview-card-image" class="preview__card-image" src="#" alt="card image">
                    </div>
                    <div class="preview__card-content">
                        <h2 id="card-preview-title" class="preview__card-title">New Post</h2>
                        <p id="card-preview-description" class="preview__card-description">Please, enter any description</p>
                    </div>
                    <div class="preview__card-info">
                        <div class="preview__card-author">
                            <div class="preview__card-author-image-block">
                                <img id="card-preview-author-photo" class="preview__card-author-image" src="/static/img/Author.png" alt="">
                            </div>
                            <div id="card-preview-author-name" class="preview__card-author-name">Enter author name</div>
                        </div>
                        <div id="card-preview-publish-date" class="preview__card-publish-date">4/19/2023</div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="publish-content container">
        <h2 class="publish-content__title">Content</h2>
        <label class="publish-content__label-textarea" for="">Post content (plain text)</label>
        <textarea id="form-text-content" class="publish-content__textarea" name="content" id="publish-content__textarea" placeholder="Type anything you want ..." rows="7"></textarea>
        <p id="input-text-content-critical" class="publish-content__textarea-critical">Content post is required.</p>
    </div>
</main>



<footer>

</footer>

</body>
</html>
