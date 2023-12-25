<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Agency</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        ol {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            color: black;
        }

        th {
            background-color: #28612e;
        }

        h1 {
            margin-top: 50px;
            color: black;
            position: relative;
            font-weight: bold;
        }


    </style>
</head>

<body>

<?php
$user_role = $_SESSION['user_role'];
if (!isset($_SESSION['username'])) {
        echo"<a href='../controllers/register_controller.php'>";
        echo "<button class='form-group button-signup'>Зарегистрироваться</button>";
        echo "</a><br><br>";

        echo "<a href='../controllers/login_controller.php'>";
        echo "<button class='form-group button-signin'>Войти</button>";
        echo "</a><br><br";
        
     } elseif ($user_role == 'Client'){
        $username = $_SESSION['username'];
        echo "<h2>Добро пожаловать, $username! </h2><br><br>";
        echo "<a href='../logout.php'>";
        echo "<button class='form-group button-signin'>Выйти</button>";
        echo "</a><br><br>";
        echo "<a href='../controllers/client_controller.php'>";
        echo "<button class='form-group button-signin'>Личный кабинет клиента</button>";
        echo "</a><br><br>";
     } elseif ($user_role == 'Worker'){
        $username = $_SESSION['username'];
        echo "<h2>Добро пожаловать, $username! </h2><br><br>";
        echo "<a href='../logout.php'>";
        echo "<button class='form-group button-signin'>Выйти</button>";
        echo "</a><br><br>";
        echo "<a href='../controllers/worker_controller.php'>";
        echo "<button class='form-group button-signin'>Личный кабинет сотрудника</button>";
        echo "</a><br><br>";

     }
    ?>
    
    <h3>Search by Country and Price:</h3> <br>
    <form method="post" action="">
        <label for="country">Страна:</label>
        <input type="text" name="country" id="country" required>
        <label for="price">Цена меньше чем:</label>
        <input type="number" name="price" id="price" required>
        <button type="submit" name="btnSearchPrice">Поиск</button>
    </form>

    <h3>Search Provider's Rating:</h3> <br>
    <form method="post" action="">
        <label for="country">Страна:</label>
        <input type="text" name="country" id="country" required>
        <button type="submit" name="btnSearchRating">Поиск</button>
    </form>
    </body>
</html>