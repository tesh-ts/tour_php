<?php
$servername = "db";
$username = "user";
$password = "123";
$dbname = "tourdb"; 

include '../models/register_model.php';

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


include '../views/register_view.php';
?>