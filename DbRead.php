<?php
require 'DbConnect.php';


function login($userName, $password)
{
    $conn = connect();
    $sql = $conn->prepare("SELECT * FROM USERS WHERE usernaame = ? and password = ?");
    $sql->bind_param("ss", $userName, $password);
    $sql->execute();
    $res = $sql->get_result();

    return $res->num_rows === 1;
}
