<?php
$host = "localhost";
$usuario = "root";        // seu usuário do MySQL
$senha = "";              // sua senha do MySQL
$banco = "sistema_onibus"; // nome do banco de dados

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
