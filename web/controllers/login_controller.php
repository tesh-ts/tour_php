<?php
session_start(); 
$servername = "db";
$username = "user";
$password = "123";
$dbname = "tourdb"; 

include '../models/login_model.php';

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
    }else{
        echo 'Пользователя с таким username не существует! Смените username или попробуйте зарегистрироваться';
    }
}


include '../views/login_view.php';
?>