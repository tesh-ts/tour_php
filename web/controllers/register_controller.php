<?php
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
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_role = $_POST['user_role'];  

    $result = selectRegister($conn, $username);
    if ($result->num_rows > 0) {
        echo 'Пользователь с таким username уже существует! Смените username или попробуйте войти';
    } else {
        $result = insertRegister($conn, $username, $email, $password, $user_role);
        if ($result) {
            header("Location: ../index.php");
            exit();
        } else {
            echo 'Ошибка при регистрации';
        }
    }
}
function executeQuery($conn, $sql)
    {
        $result = $conn->query($sql);

        if ($result) {
            return $result;
        } 
    }
    
     
function selectRegister($conn, $username)
    {
        $sql = "SELECT * FROM user WHERE username = '$username'";
        return executeQuery($conn, $sql);
    }
function insertRegister($conn, $username, $email, $password, $user_role)
    {
        $sql = "INSERT INTO user (username, email, password, user_role) VALUES ('$username', '$email', '$password', '$user_role')";
        return executeQuery($conn, $sql);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>
<body>
    <form method="post" action="">
        <label for="username">Имя пользователя:</label>
        <input type="text" id="username" name="username" required> <br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required> <br><br>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required> <br><br>

        <label for="user_role">Роль:</label>
        <select id="user_role" name="user_role">
            <option value="Client">Client</option>
            <option value="Worker">Worker</option>
        </select> <br><br>

        <button type="submit">Зарегистрироваться</button> <br><br>
    </form>
    <a href="../index.php">Вернуться на главную страницу</a>
</body>
</html>