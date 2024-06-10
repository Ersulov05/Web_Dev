<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <div>Всем привет</div>
  <div>Версия PHP: <?php print phpversion(); ?></div>

  <?php
// 1. вывести все данные о сервере и заголовках
echo 'Данные в глоабльном массиве $_SERVER';
foreach ($_SERVER as $key => $header) {
  echo "{$key} = {$header} </br>";
}
echo '<br>---------------<br>';


$requestTime = $_SERVER['REQUEST_TIME'];
echo "Timestamp запроса {$requestTime} <br>";

$now = date("Y-m-d H:i:s");
echo "Текущая дата и время: {$now} <br>";

$a = 111111;
// 3.2 работа с timestamp: вывести определенную дату и время в определенном формате
$requestDateTime = date("Y-m-d H:i:s", $a);
echo "Дата и время запроса: {$requestDateTime} <br>";


$lastDay = date("H*i*s Y/m/d", 1443139200);
echo "Последний день учебы: {$lastDay} <br>";


// 3.3 работа с timestamp: превратить дату в timestamp
$timestampNow = strtotime('now');
echo "Текущий timestamp: {$timestampNow} <br>";

$timestampDatetime = strtotime($now);
echo "Текущий timestamp: {$timestampDatetime} <br>";

$timestampNextWeek = strtotime('+1 week 2 days 4 hours 2 seconds');
echo "Какой-то timestamp на след неделе {$timestampNextWeek} <br>";




// 3.4 работа с timestamp: выводим timestamp определенной даты
echo mktime(9, 24, 57, 5, 23, 1995) . '<br>';

echo '<br>---------------<br>'  ;




// 4. вывести метод, URL и IP
$method = $_SERVER['REQUEST_METHOD'];
$url = $_SERVER['REQUEST_URI'];
$ipAddress = $_SERVER['REMOTE_ADDR'];

echo 'Method: ' . $method . '</br>';
echo 'URL: ' . $url . '</br>';
echo 'IP Address: ' . $ipAddress . '</br>';

echo '<br>---------------<br>';



// 5. Распечатаем все GET-параметры
foreach ($_GET as $key => $value) {
  echo "{$key} = {$value} </br>";
}


// 6. Распечатаем все POST-параметры
foreach ($_POST as $key => $value) {
  echo "{$key} = {$value} </br>";
}


echo mktime(0, 0, 0, 9, 25, 2015) . '<br>';



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

$dataAsJson = getPostJson();
if ($dataAsJson) {
  print_r($dataAsJson . '<br>');
  print_r(getPostJsonAsArray($dataAsJson));
  echo '<br><br>';
}





/* <?php
// 1. вывести все данные о сервере и заголовках
echo 'Данные в глоабльном массиве $_SERVER';
foreach ($_SERVER as $key => $header) {
  echo "{$key} = {$header} </br>";
}
echo '<br>---------------<br>';

// 2. вывести время запроса
$requestTime = $_SERVER['REQUEST_TIME'];
echo "Timestamp запроса {$requestTime} <br>";

// 3.1 работа с timestamp: вывести текущее дата+время в определенном формате
// все форматы https://www.php.net/manual/ru/datetime.format.php
$now = date("Y-m-d H:i:s");
echo "Текущая дата и время: {$now} <br>";

// 3.2 работа с timestamp: вывести определенную дату и время в определенном формате
$requestDateTime = date("Y-m-d H:i:s", $requestTime);
echo "Дата и время запроса: {$requestDateTime} <br>";

$lastDay = date("H*i*s Y/m/d", 1717189199);
echo "Последний день учебы: {$lastDay} <br>";

// 3.3 работа с timestamp: превратить дату в timestamp
$timestampNow = strtotime('now');
echo "Текущий timestamp: {$timestampNow} <br>";

$timestampDatetime = strtotime($now);
echo "Текущий timestamp: {$timestampDatetime} <br>";

$timestampNextWeek = strtotime('+1 week 2 days 4 hours 2 seconds');
echo "Какой-то timestamp на след неделе {$timestampNextWeek} <br>";

// 3.4 работа с timestamp: выводим timestamp определенной даты
echo mktime(9, 24, 57, 5, 23, 1995) . '<br>';

echo '<br>---------------<br>';


// 4. вывести метод, URL и IP
$method = $_SERVER['REQUEST_METHOD'];
$url = $_SERVER['REQUEST_URI'];
$ipAddress = $_SERVER['REMOTE_ADDR'];

echo 'Method: ' . $method . '</br>';
echo 'URL: ' . $url . '</br>';
echo 'IP Address: ' . $ipAddress . '</br>';

echo '<br>---------------<br>';

// 5. Распечатаем все GET-параметры
foreach ($_GET as $key => $value) {
  echo "{$key} = {$value} </br>";
}

// 6. Распечатаем все POST-параметры
foreach ($_POST as $key => $value) {
  echo "{$key} = {$value} </br>";
}*/


const HOST = 'localhost';
const USERNAME = 'blog_user';
const PASSWORD = '315589+Blog';
const DATABASE = 'blog';

function createDBConnection(): mysqli {
  
  $conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  echo "Connected successfully<br>";
  return $conn;
}


function getAndPrintPostsFromDB(mysqli $conn): void {
  $sql = "SELECT * FROM post";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "Author: {$row['author']} - Title: {$row['title']} - Subtitle: {$row['subtitle']} - Date: {$row['publish_date']} - Is Featured: {$row['featured']} <br>";
    }
  } else {
    echo "0 results";
  }
}

function closeDBConnection(mysqli $conn): void {
  $conn->close();
}


$conn = createDBConnection();
getAndPrintPostsFromDB($conn);
closeDBConnection($conn);








?>








</body>
</html>
