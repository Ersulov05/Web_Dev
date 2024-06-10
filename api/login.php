<?php
$method = $_SERVER['REQUEST_METHOD'];
//echo "$method\n";

require_once 'connect.php';

$salt = 'asdxfase';
$password = md5(md5('qwerty1') . $salt);
echo $password;

function createDBConnection(): mysqli {
  
  $conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
  if ($conn->connect_error) {
    header("Location: /login.php", TRUE, 503);
    die("Connection failed: " . $conn->connect_error);
  }

  //echo "Connected successfully\n";
  return $conn;
}

function searchUserFromDB(mysqli $conn, string $login): array {
    $sql = "SELECT * FROM user WHERE email = '$login'";
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


function getUserDataJson(): ?string {
    $dataAsJson = file_get_contents("php://input");
    if (!$dataAsJson) {
      //echo 'Не удалось считать данные! <br>';
      return null;
    }
    return $dataAsJson;
}

function getUserJsonAsArray(string $dataAsJson): array {
    $dataAsArray = json_decode($dataAsJson, true);
    if (!$dataAsArray) {
      //echo 'Не удалось преобразовать JSON в массив! <br>';
      return [];
    }
    return $dataAsArray;
}
 
function validateUserData(array $userData): bool
{
    if (key_exists('login', $userData) && key_exists('password', $userData))
    {
        if (filter_var($userData['login'], FILTER_VALIDATE_EMAIL) && (strlen($userData['password']) >= 6))
        {
            return true;
        }
    }
    return false;
}

if ($method != 'POST')
{
  //echo 'Неверный метод запроса, используйте POST';
  header("Location: /login.php", TRUE, 400);
  return;
}


$userDataJson = getUserDataJson();
if ($userDataJson === null)
{
    header("Location: /login.php", TRUE, 400);
    return;
}
$userData = getUserJsonAsArray($userDataJson);

if (validateUserData($userData)){
    $conn = createDBConnection();
    $userLogin = $userData['login'];
    $user = searchUserFromDB($conn, $userLogin);
    if ($user){
        $salt = 'asdxfase';
        $password = md5(md5($userData['password']) . $salt);
        if ($password == $user['password'])
        {
            echo 'Password True';
            session_name('auth');
            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            header("Location: /login.php", TRUE, 200);
        }
        else{
            echo 'password False';
            header("Location: /login.php", TRUE, 401);
        }
    }
    else{
        echo 'not user';
        header("Location: /login.php", TRUE, 401);
    }
} else {
    header("Location: /login.php", TRUE, 401);
}

