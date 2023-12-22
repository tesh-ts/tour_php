<?php

$servername = "db";
$username = "user";
$password = "123";
$dbname = "tourdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

include '../models/client_model.php';
include '../views/client_view.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $tourId = $_POST['tour_id'];
    $username = $_SESSION['username']; 

    $result = selectOrder($conn, $tourId, $username);
    if ($result->num_rows > 0) {
        echo 'Заказ уже существовал, так что мы прибавим количество!';
        $row = $result->fetch_assoc();
        $orderId = $row['id'];
        $newQuantity = $row['kolvo'] + 1;
        $result = updateOrder($conn, $orderId, $newQuantity);

    } else {
        echo 'Заказа не было, добавляем';
        $result = addOrder($conn, $tourId, $username);
    }
   
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_order'])){
            $orderId = $_POST['order_id'];
            $result = deleteOrder($conn, $orderId);
            
            exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['increase_quantity'])) {
    $orderId = $_POST['order_id'];
    $result = plusKolvo($conn, $orderId);
   
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['decrease_quantity'])) {
    $orderId = $_POST['order_id'];

    $result = minusKolvo($conn, $orderId);
    if ($result) {
        
        $result = selectKolvo($conn, $orderId);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['kolvo'] == 0) {
                $result = deleteOrder($conn, $orderId);
            }
        }

    }
    
    exit();
}

$conn->close();
?>
