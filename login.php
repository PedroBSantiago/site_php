<?php
include("conexao.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = $usuario['nome'];
            header("Location: home.php");
            exit;
        } else {
            echo "<script>alert('Senha incorreta!');</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado!');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: radial-gradient(circle at top, #0a0a0a 0%, #000 100%);
      color: white;
      font-family: 'Poppins', sans-serif;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .login-container {
      width: 380px;
      background: rgba(30,30,30,0.85);
      border-radius: 20px;
      box-shadow: 0 0 25px rgba(0,255,255,0.2);
      padding: 40px 30px;
      animation: fadeIn 1s ease-in-out;
    }
    h2 {
      text-align: center;
      color: #00ffff;
      text-shadow: 0 0 10px #00ffff;
      margin-bottom: 25px;
    }
    .form-control {
      background: rgba(255,255,255,0.1);
      border: none;
      border-radius: 25px;
      color: white;
      margin-bottom: 15px;
      padding: 12px 20px;
    }
    .btn-login {
      width: 100%;
      border-radius: 25px;
      background: linear-gradient(90deg, #00ffff, #0077ff);
      border: none;
      color: black;
      font-weight: bold;
      transition: all 0.3s;
      box-shadow: 0 0 15px #00ffff;
    }
    .btn-login:hover {
      transform: scale(1.05);
      box-shadow: 0 0 30px #00ffff;
    }
    a { color: #00ffff; text-decoration: none; }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <form method="POST" action="">
      <input type="email" class="form-control" name="email" placeholder="Email" required>
      <input type="password" class="form-control" name="senha" placeholder="Senha" required>
      <button type="submit" class="btn btn-login">Entrar</button>
      <div class="text-center mt-3">
        <small>Não tem conta? <a href="cadastro.php">Cadastre-se</a></small>
      </div>
    </form>
  </div>
</body>
</html>
