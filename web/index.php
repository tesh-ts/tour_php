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

include 'models/main_model.php';
include 'views/main_view.php';

  
if (isset($_POST["btnSearchPrice"])) {
    $country = $_POST["country"];
    $price = $_POST["price"];
       
    $result = selectPrice($conn, $country, $price);
    displaySearchResults($result);
}

if (isset($_POST["btnSearchRating"])) {
    $country = $_POST["country"];
        
    $result = selectRating($conn, $country);
    displaySearchResults($result);
}


$tables = ['orders', 'user', 'tours', 'providers'];


foreach ($tables as $table) {
    echo "<h1 id='$table'><a name='$table'>$table</a></h1>";
       

    $sqlSelect = "SELECT * FROM $table";
    $resultSelect = executeQuery($conn, $sqlSelect);
    echo "<table><tr>";
    $headers = array_keys($resultSelect->fetch_assoc());
    foreach ($headers as $header) {
        echo "<th>$header</th>";
    }
    echo "</tr>";

    $resultSelect->data_seek(0);
    while ($row = $resultSelect->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>$value</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
        
}
    

    
$conn->close();
    
?>









