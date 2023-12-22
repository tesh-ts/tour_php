<?php
session_start(); 
$servername = "db";
$username = "user";
$password = "123";
$dbname = "tourdb"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

   
    $result = selectLogin($conn, $username, $password);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userRole = $row['user_role'];
        
        $_SESSION['username'] = $username;
        $_SESSION['user_role'] = $userRole;
        header("Location: ../index.php");
        exit();
    } else {
        echo 'Неверный пароль или имя пользователя! Попробуй еще раз';
    }
}
function executeQuery($conn, $sql)
    {
        $result = $conn->query($sql);

        if ($result) {
            return $result;
        } 
    }
    
     
function selectLogin($conn, $username, $password)
    {
        $sql = "SELECT id, username, password, user_role FROM user WHERE username = '$username' AND password = '$password'";
        return executeQuery($conn, $sql);
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
</head>
<body>
    <form method="post" action="">
        <label for="username">Имя пользователя:</label>
        <input type="text" id="username" name="username" required> <br><br>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required> <br><br>

        <button type="submit">Войти</button> <br><br>
    </form>
    <a href="../index.php">Вернуться на главную страницу</a>
</body>
</html>