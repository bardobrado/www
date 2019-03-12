<?php

$conn = new mysqli("localhost", "root", "", "dbphp7");

if ($conn->connect_error) {
    echo "Error: ". $conn->connect_error;
}

$stmt = $conn->prepare("INSERT  INTO tb_usuarios (deslogin, dessenha) VALUES(?,?)");

$login = "user";
$senha = "12345";

$stmt->bind_param("ss", $login, $senha);

$stmt->execute();

$login = "root";
$senha = "2222";

$stmt->execute();


?>