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

include '../models/worker_model.php';
include '../views/worker_view.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_tour'])) {
        $country = $_POST['new_country'];
        $town = $_POST['new_town'];
        $duration = $_POST['new_duration'];
        $price = $_POST['new_price'];
        $provider_id = $_POST['new_provider_id'];

        $result = addTour($conn, $country, $town, $duration, $price, $provider_id);
}
        
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_tour'])) {
        $tourId = $_POST['id_to_update'];
        $updatedCountry = $_POST['updated_country'];
        $updatedTown = $_POST['updated_town'];
        $updatedDuration = $_POST['updated_duration'];
        $updatedPrice = $_POST['updated_price'];
        $updatedProviderId = $_POST['updated_provider_id'];

        $result = updateTour($conn, $updatedCountry, $updatedTown, $updatedDuration, $updatedPrice, $updatedProviderId, $tourId);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_tour']))  {
        $tourIdToDelete = $_POST['id_to_delete'];

        $result = deleteTour($conn, $tourIdToDelete);

}



$conn->close();
?>


