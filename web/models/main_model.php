<?php


function displaySearchResults($result)
{
    if ($result->num_rows > 0) {
        echo "<h1>Search Results:</h1>";
        while ($row = $result->fetch_assoc()) {
            foreach ($row as $key => $value) {
                echo "$key: $value, ";
            }
            echo "<br>";
        }
    } else {
        echo "<p>No results found.</p>";
    }
}

function executeQuery($conn, $sql)
    {
        $result = $conn->query($sql);

        if ($result === false) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        } else {
            return $result;
        }
    }

function selectPrice($conn, $country, $price)
    {
        $sql = "SELECT country, town, duration, price FROM tours WHERE country = '$country' AND price < '$price'";
        return executeQuery($conn, $sql);
    }

function selectRating($conn, $country)
    {
        $sql = "SELECT t.country, t.town, t.price, t.duration, p.rating AS rating_of_provider FROM tours as t INNER JOIN providers as p ON t.provider_id = p.id where country = '$country'";
        return executeQuery($conn, $sql);
    }
?>