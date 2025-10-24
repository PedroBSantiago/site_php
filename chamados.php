<?php
session_start();
include("conexao.php");
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit;
}
$usuario = $_SESSION['usuario'];

// Adiciona novo chamado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $titulo = $_POST['titulo'];
  $descricao = $_POST['descricao'];

  $sql = "INSERT INTO chamados (titulo, descricao, usuario) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $titulo, $descricao, $usuario);
  $stmt->execute();
  $stmt->close();
  header("Location: chamados.php");
  exit;
}

// Deleta chamado
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  $sql = "DELETE FROM chamados WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->close();
  header("Location: chamados.php");
  exit;
}

// Lista chamados
$sql = "SELECT * FROM chamados ORDER BY data_abertura DESC";
$result = $conn->query($sql);
?>
