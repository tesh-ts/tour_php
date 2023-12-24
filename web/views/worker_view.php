
<?php
if (!isset($_SESSION['username'])) {
    header("Location: ../controllers/login_controller.php");
    exit();
}

$getToursStmt = $conn->prepare("SELECT * FROM tours");
$getToursStmt->execute();
$tours = $getToursStmt->get_result()->fetch_all(MYSQLI_ASSOC);


if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    ?>
    <h2>Доступные туры:</h2>
    <ul>
        <?php foreach ($tours as $tour): ?>
            <li>
                <?php echo $tour['id'] . '. Страна: ' . $tour['country'] . ', Город: ' . $tour['town'] . ' , Продолжительность: ' . $tour['duration'] . ' , Цена: ' . $tour['price'] . '$, Поставщик: ' . $tour['provider_id']; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет сотрудника</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
    <h1>Личный кабинет</h1>
    <p>Привет, <?php echo $_SESSION['username']; ?>!</p>
    <div id="toursTableContainer">
    <h2>Доступные туры:</h2>
    <ul>
        <?php foreach ($tours as $tour): ?>
            <li>
                <?php echo $tour['id'] . '. Страна: ' . $tour['country'] . ', Город: ' . $tour['town'] . ' , Продолжительность: ' . $tour['duration'] . ' , Цена: ' . $tour['price'] . '$, Поставщик: ' . $tour['provider_id']; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    </div>
    <h2>Форма добавления нового тура</h2>
    <form method="post">
        <input type="text" name="new_country" placeholder="Country">
        <input type="text" name="new_town" placeholder="Town">
        <input type="text" name="new_duration" placeholder="Duration">
        <input type="text" name="new_price" placeholder="Price">
        <input type="text" name="new_provider_id" placeholder="Provider_ID">
        <button type="submit" name="add_tour">Добавить тур</button>
    </form>

    <h2>Форма обновления информации о туре</h2>
    <form method="post">
        <input type="text" name="id_to_update" placeholder="Id to Update"> 
        <input type="text" name="updated_country" placeholder="Updated Country">
        <input type="text" name="updated_town" placeholder="Updated Town">
        <input type="text" name="updated_duration" placeholder="Updated Duration">
        <input type="text" name="updated_price" placeholder="Updated Price">
        <input type="text" name="updated_provider_id" placeholder="Updated Provider_ID">
        <button type="submit" name="update_tour">Обновить тур</button>
    </form>

    <h2>Форма удаления тура</h2>
    <form method="post">
    <input type="text" name="id_to_delete" placeholder="Id to Delete"> 
        <button type="submit" name="delete_tour">Удалить тур</button>
    </form>

    <p><a href="../logout.php">Выйти из учетной записи</a></p> <br>
    <p><a href="../index.php">Вернуться на главную страницу</a></p>

    
    <script>

        function updatePage() {
            $.ajax({
                type: 'POST',
                url: 'worker_controller.php',
                data: { },
                success: function(response) {
                    $('#toursTableContainer').empty().html(response);
                },
                error: function(error) {
                    console.error('Ошибка AJAX:', error);
                }
            });
        }

        updatePage();
        
    </script>
</body>
</html>