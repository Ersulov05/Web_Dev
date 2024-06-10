<?php
$method = $_SERVER['REQUEST_METHOD'];
echo "$method\n";

require_once 'connect.php';

function createDBConnection(): mysqli {
  
  $conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  echo "Connected successfully\n";
  return $conn;
}


function getAndPrintFeaturePostFromDB(mysqli $conn): void {
  $sql = "SELECT * FROM post WHERE featured = 1";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($post = $result->fetch_assoc()) {
        include 'feature-post-preview.php';
    }
  } else {
    echo "0 results";
  }
}

function closeDBConnection(mysqli $conn): void {
  $conn->close();
}


function getPostJson(): ?string {
    $dataAsJson = file_get_contents("php://input");
    if (!$dataAsJson) {
      echo 'Не удалось считать данные! <br>';
      return null;
    }
    return $dataAsJson;
}

function getPostJsonAsArray(string $dataAsJson): array {
    $dataAsArray = json_decode($dataAsJson, true);
    if (!$dataAsArray) {
      echo 'Не удалось преобразовать JSON в массив! <br>';
      return [];
    }
    return $dataAsArray;
}

function saveFile(string $file, string $data): void {
    $myFile = fopen($file, 'w');
    if ($myFile) {
      $result = fwrite($myFile, $data);
      if ($result) {
        echo "Данные успешно сохранены в файл \n";
      } else {
        echo 'Произошла ошибка при сохранении данных в файл <br>';
      }
      fclose($myFile);
    } else {
      echo 'Произошла ошибка при открытии файла <br>';
    }
}

function saveImage(string $imageBase64, string $data): string {
  $imageBase64Array = explode(';base64,', $imageBase64);
  $imgExtention = str_replace('data:image/', '', $imageBase64Array[0]);
  $imageDecoded = base64_decode($imageBase64Array[1]);
  saveFile("src/img/$data.{$imgExtention}", $imageDecoded);
  return $imgExtention;
}

if ($method != 'POST')
{
  echo 'Неверный метод запроса, используйте POST';
  return;
} 

$dataAsJson = getPostJson();
if ($dataAsJson) {
  saveFile('data.json', $dataAsJson);
}

if ($dataAsJson) {
  $dataAsArray = getPostJsonAsArray($dataAsJson);
  if ((0 < strlen($dataAsArray['author_name'])) && (0 < strlen($dataAsArray['title'])) && 
  (0 < strlen($dataAsArray['description'])) && (0 < strlen($dataAsArray['content'])) &&
  (0 < strlen($dataAsArray['author_photo'])) && ($dataAsArray['article_image']))
  {
    
    $timestamp = date("Y-m-d H:i:s");
    $title = $dataAsArray['title'];
    $description = $dataAsArray['description'];
    $content = $dataAsArray['content'];
    $featured = $dataAsArray['featured'];
    if (($featured != '0') && ($featured != '1'))
    {
      $featured = '0';
    }
    $author_name = $dataAsArray['author_name'];
    $author_photo = $dataAsArray['author_photo'];
    $card_image = $dataAsArray['card_image'];
    $article_image = $dataAsArray['article_image'];
    $publish_date = $dataAsArray['publish_date'];

    $conn = createDBConnection();
    $conn->query("SET information_schema_stats_expiry = 0");
    $sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'blog' AND TABLE_NAME = 'post'";
    $result = $conn->query($sql);
    $id = ($result->fetch_assoc())['AUTO_INCREMENT'];
    echo $id;
    $ExtensionAuthorPhoto = saveImage($author_photo, "author_photo$id");
    $ExtensionMainImage = saveImage($article_image, "article_image$id");
    $ExtensionCardImage = saveImage($card_image, "card_image$id");
   
    echo "+++";
    $sql = "INSERT INTO post (title, subtitle, content, author, author_url, publish_date, image_url, featured, card_image_url)
    VALUES ('$title', '$description', '$content', '$author_name', 'author_photo$id.$ExtensionAuthorPhoto', '$publish_date', 'article_image$id.$ExtensionMainImage', '$featured', 'card_image$id.$ExtensionCardImage')";
    $conn->query($sql);
    echo "111";
    closeDBConnection($conn);
  }
  else{
    echo "Incorrect data";
  }
}


?>