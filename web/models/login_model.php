<?php
function executeQuery($conn, $sql)
    {
        $result = $conn->query($sql);

        if ($result) {
            return $result;
        } 
    }
function selectLogin($conn, $username, $password)
    {
        $sql = "SELECT id, username, password, user_role FROM user WHERE username = '$username' AND password = '$password'";
        return executeQuery($conn, $sql);
    }
?>