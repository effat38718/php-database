<?php
require 'DbConnect.php';

function register($userName, $position, $password)
{
    $conn = connect();
    $sql = $conn->prepare("INSERT INTO USERS (usernaame, position, password) VALUES (?, ?, ?)");
    $sql->bind_param("sss", $userName, $position, $password);
    return $sql->execute();
}
