<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit;
}
$nome = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: radial-gradient(circle at top left, #001122, #000);
      color: white;
      font-family: 'Poppins';
      text-align: center;
      padding-top: 100px;
    }
    h1 {
      color: #00ffff;
      text-shadow: 0 0 20px #00ffff;
      animation: glow 2s infinite alternate;
    }
    @keyframes glow {
      from { text-shadow: 0 0 10px #00ffff; }
      to { text-shadow: 0 0 30px #00ffff; }
    }
    .btn-chamados {
      background: linear-gradient(90deg, #00ffff, #0077ff);
      border: none;
      border-radius: 25px;
      padding: 12px 25px;
      color: black;
      font-weight: bold;
      box-shadow: 0 0 15px #00ffff;
      transition: 0.3s;
    }
    .btn-chamados:hover { transform: scale(1.05); box-shadow: 0 0 30px #00ffff; }
  </style>
</head>
<body>
  <h1>Bem-vindo, <?php echo $nome; ?>!</h1>
  <p class="mt-3">Sistema de Ônibus - Página Inicial</p>
 <a href="chamados.php" class="btn btn-chamados mt-4">Ir para Chamados</a>
  <a href="logout.php" style="color:#00ffff;">Sair</a>
</body>
</html>
