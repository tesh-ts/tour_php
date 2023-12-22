<?php
function executeQuery($conn, $sql)
    {
        $result = $conn->query($sql);

        if ($result) {
            echo 'Успешная операция!';
        } else {
            echo 'Ошибка' . $conn->error;
        }
    }
    
     
function addTour($conn, $country, $town, $duration, $price, $provider_id)
    {
        $sql = "INSERT INTO tours (country, town, duration, price, provider_id) VALUES ('$country', '$town', '$duration','$price', '$provider_id')";
        return executeQuery($conn, $sql);
    }
    
function updateTour($conn, $updatedCountry, $updatedTown, $updatedDuration, $updatedPrice, $updatedProviderId, $tourId)
    {
        $sql = "UPDATE tours SET country = '$updatedCountry', town = '$updatedTown', duration = '$updatedDuration', price = '$updatedPrice', provider_id = '$updatedProviderId' WHERE id = $tourId";
        return executeQuery($conn, $sql);
    }
function deleteTour($conn, $tourIdToDelete)
    {
        $sql = "DELETE FROM tours WHERE id = $tourIdToDelete";  
        return executeQuery($conn, $sql);
    }

?>