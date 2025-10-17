<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $origem = $_POST['origem'];

    $sql = "INSERT INTO usuarios (nome, email, senha, origem) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $email, $senha, $origem);

    if ($stmt->execute()) {
        echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar!');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #000 0%, #002244 100%);
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .form-container {
      background: rgba(30,30,30,0.9);
      border-radius: 20px;
      box-shadow: 0 0 25px rgba(0,255,255,0.3);
      padding: 40px;
      width: 400px;
      animation: slideIn 1s ease;
    }
    h2 { color: #00ffff; text-align: center; margin-bottom: 20px; }
    .form-control { margin-bottom: 15px; background: rgba(255,255,255,0.1); color: white; border: none; }
    .btn-cadastrar {
      width: 100%;
      border-radius: 25px;
      background: linear-gradient(90deg, #00ffff, #0077ff);
      color: black;
      font-weight: bold;
      border: none;
      box-shadow: 0 0 15px #00ffff;
      transition: 0.3s;
    }
    .btn-cadastrar:hover { transform: scale(1.05); box-shadow: 0 0 30px #00ffff; }
    a { color: #00ffff; text-decoration: none; }
    @keyframes slideIn { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Cadastro</h2>
    <form method="POST" action="">
      <input type="text" class="form-control" name="nome" placeholder="Nome completo" required>
      <input type="email" class="form-control" name="email" placeholder="Email" required>
      <input type="password" class="form-control" name="senha" placeholder="Senha" required>
      <input type="text" class="form-control" name="origem" placeholder="Origem (ex: Mongaguá)" required>
      <button type="submit" class="btn btn-cadastrar">Cadastrar</button>
      <div class="text-center mt-3">
        <small>Já tem conta? <a href="login.php">Entrar</a></small>
      </div>
    </form>
  </div>
</body>
</html>
