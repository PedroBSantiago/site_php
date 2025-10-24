<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome            = $_POST['nome'];
    $email           = $_POST['email'];
    $setor           = $_POST['setor'];
    $telefone        = $_POST['telefone'];
    $senha           = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar'];

    // Verifica se as senhas coincidem
    if ($senha !== $confirmar_senha) {
        echo "<script>alert('As senhas não coincidem!'); window.history.back();</script>";
        exit();
    }

    // Criptografa a senha antes de salvar
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Insere os dados usando prepared statements (seguro contra SQL injection)
    $sql = "INSERT INTO usuario (nome, email, setor, telefone, senha) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nome, $email, $setor, $telefone, $senha_hash);

    if ($stmt->execute()) {
        echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar!');</script>";
    }

    $stmt->close();
}
?>