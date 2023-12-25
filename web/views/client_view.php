<?php


if (!isset($_SESSION['username'])) {
    header("Location: ../controllers/login_controller.php");
    exit();
}

$getToursStmt = $conn->prepare("SELECT id, country, town, price, provider_id FROM tours");
$getToursStmt->execute();
$tours = $getToursStmt->get_result()->fetch_all(MYSQLI_ASSOC);

$username = $_SESSION['username'];
$getOrdersStmt = $conn->prepare("SELECT o.id as order_id, o.kolvo, t.id as tour_id, t.country, t.town, t.price FROM orders o JOIN tours t ON o.tour_id = t.id WHERE o.cl_username = ?");
if ($getOrdersStmt === false) {
    die('Error in prepare statement: ' . $conn->error);
}
$getOrdersStmt->bind_param('s', $username);
$getOrdersStmt->execute();
$orders = $getOrdersStmt->get_result()->fetch_all(MYSQLI_ASSOC);


$totalPrice = 0;
foreach ($orders as $order) {
    $tourId = $order['tour_id'];
    $getTourPriceStmt = $conn->prepare("SELECT price FROM tours WHERE id = ?");
    $getTourPriceStmt->bind_param('i', $tourId);
    $getTourPriceStmt->execute();
    $tourPrice = $getTourPriceStmt->get_result()->fetch_assoc()['price'];

    $totalPrice += $tourPrice * $order['kolvo'];

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>
<body>
    <div id="full">
    <h1>Личный кабинет клиента</h1>
    <p>Привет, <?php echo $_SESSION['username']; ?>!</p>

    <h2>Доступные туры:</h2>
    <ul>
        <?php foreach ($tours as $tour): ?>
            <li>
                <?php echo $tour['id'] . '. ' . $tour['country'] . ', ' . $tour['town'] . ' - ' . $tour['price']; ?> $.
                <form method="post" id="addTourForm">
                    <input type="hidden" name="tour_id" value="<?php echo $tour['id']; ?>">
                    <button type="submit" name="add_to_cart">Добавить в корзину</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Ваш заказ:</h2>
    <ul>
        <?php foreach ($orders as $order): ?>
            <li class="order-item">
                <?php echo 'Тур №' . $order['tour_id'] . ', Количество: ' . $order['kolvo']; ?>
                <form method="post" id="deleteTourForm">
                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                    <button type="submit" name="remove_order">Удалить заказ</button> 
                </form>
                <form method="post" id="plusTourForm">
                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                    <button type="submit" name="increase_quantity">+</button> 
                </form>
                <form method="post" id="minusTourForm">
                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                    <button type="submit" name="decrease_quantity">-</button>
                </form><br>
            </li>
            
        <?php endforeach; ?>
        <h3>Общая сумма в корзине: <?php echo $totalPrice; ?> $</h3>
    </ul>

    <p><a href="../logout.php">Выйти из учетной записи</a></p> <br>
    <p><a href="../index.php">Вернуться на главную страницу</a></p>
    </div>
    <style>
        .order-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px; 
        }

        .order-item form {
            margin-left: 10px;
        }
    </style>
    <script>

        function updatePage() {
            $.ajax({
                type: 'POST',
                url: 'client_controller.php',
                data: { },
                success: function(response) {
                    $('#full').empty().html(response);
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