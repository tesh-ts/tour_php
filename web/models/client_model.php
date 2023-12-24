<?php
function executeQuery($conn, $sql)
    {
        $result = $conn->query($sql);

        if ($result) {
            echo 'Успешная операция!';
            return $result;
        } else {
            echo 'Ошибка' . $conn->error;
        }
    }
    
function selectOrder($conn, $tourId, $username)
    {
        $sql = "SELECT id, kolvo FROM orders WHERE cl_username = '$username' AND tour_id = '$tourId'";
        return executeQuery($conn, $sql);
    }
    
function addOrder($conn, $tourId, $username)
    {
        $sql = "INSERT INTO orders (cl_username, tour_id, kolvo) VALUES ('$username', '$tourId', 1)";  
        return executeQuery($conn, $sql);
    }
    
function deleteOrder($conn, $orderId)
    {
        $sql = "DELETE FROM orders WHERE id = '$orderId'";  
        return executeQuery($conn, $sql);
    }  
function plusKolvo($conn, $orderId)
    {
        $sql = "UPDATE orders SET kolvo = kolvo + 1 WHERE id = '$orderId'";  
        return executeQuery($conn, $sql);
    }  
function minusKolvo($conn, $orderId)
    {
        $sql = "UPDATE orders SET kolvo = GREATEST(kolvo - 1, 0) WHERE id = '$orderId'";  
        return executeQuery($conn, $sql);
    } 
function selectKolvo($conn, $orderId)
    {
        $sql = "SELECT kolvo FROM orders WHERE id = '$orderId'";  
        return executeQuery($conn, $sql);
    } 
?>