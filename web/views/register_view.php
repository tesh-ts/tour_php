<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>
<body>
    <form method="post" action="">
        <label for="username">Имя пользователя:</label>
        <input type="text" id="username" name="username" required> <br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required> <br><br>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required> <br><br>

        <label for="user_role">Роль:</label>
        <select id="user_role" name="user_role">
            <option value="Client">Client</option>
            <option value="Worker">Worker</option>
        </select> <br><br>

        <button type="submit">Зарегистрироваться</button> <br><br>
    </form>
    <a href="../index.php">Вернуться на главную страницу</a>
</body>
</html>