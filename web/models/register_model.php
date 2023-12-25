<?php
function executeQuery($conn, $sql)
{
    $result = $conn->query($sql);

    if ($result) {
        return $result;
    } 
}

 
function selectRegister($conn, $username)
{
    $sql = "SELECT * FROM user WHERE username = '$username'";
    return executeQuery($conn, $sql);
}
function insertRegister($conn, $username, $email, $password, $user_role)
{
    $sql = "INSERT INTO user (username, email, password, user_role) VALUES ('$username', '$email', '$password', '$user_role')";
    return executeQuery($conn, $sql);
}
?>