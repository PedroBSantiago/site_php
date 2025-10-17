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
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Chamados</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: radial-gradient(circle at top, #000, #001122);
      color: white;
      font-family: 'Poppins', sans-serif;
      padding: 40px;
    }
    h1 {
      color: #00ffff;
      text-shadow: 0 0 15px #00ffff;
      text-align: center;
      margin-bottom: 30px;
      animation: glow 2s infinite alternate;
    }
    @keyframes glow {
      from { text-shadow: 0 0 10px #00ffff; }
      to { text-shadow: 0 0 30px #00ffff; }
    }
    .form-control {
      background: rgba(255,255,255,0.1);
      color: white;
      border: none;
      border-radius: 25px;
    }
    .btn-enviar, .btn-voltar {
      border-radius: 25px;
      background: linear-gradient(90deg, #00ffff, #0077ff);
      border: none;
      color: black;
      font-weight: bold;
      box-shadow: 0 0 15px #00ffff;
      transition: 0.3s;
    }
    .btn-enviar:hover, .btn-voltar:hover { transform: scale(1.05); box-shadow: 0 0 30px #00ffff; }
    .card {
      background: rgba(20,20,30,0.8);
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(0,255,255,0.3);
      margin-bottom: 20px;
      padding: 20px;
      animation: fadeIn 0.5s ease-in-out;
    }
    .delete-btn {
      color: #ff5555;
      text-decoration: none;
      font-weight: bold;
      transition: 0.3s;
    }
    .delete-btn:hover {
      color: #ff0000;
      text-shadow: 0 0 10px red;
    }
    @keyframes fadeIn { from {opacity:0; transform:translateY(-10px);} to {opacity:1; transform:translateY(0);} }
  </style>
</head>
<body>
  <h1>Chamados</h1>

  <div class="container">
    <form method="POST" action="" class="mb-4">
      <input type="text" name="titulo" class="form-control mb-2" placeholder="Título do chamado" required>
      <textarea name="descricao" class="form-control mb-2" rows="3" placeholder="Descrição do problema" required></textarea>
      <button type="submit" class="btn btn-enviar w-100">Registrar Chamado</button>
    </form>

    <a href="home.php" class="btn btn-voltar mb-4">Voltar à Home</a>
    <a href="logout.php" class="btn btn-outline-danger float-end">Sair</a>

    <h3 class="mt-4 mb-3 text-center text-info">Chamados Abertos</h3>

    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="card">
        <h5><?= htmlspecialchars($row['titulo']); ?></h5>
        <p><?= nl2br(htmlspecialchars($row['descricao'])); ?></p>
        <small>Aberto por <?= htmlspecialchars($row['usuario']); ?> em <?= $row['data_abertura']; ?></small><br>
        <a href="?delete=<?= $row['id']; ?>" class="delete-btn">Excluir</a>
      </div>
    <?php endwhile; ?>
  </div>
</body>
</html>
