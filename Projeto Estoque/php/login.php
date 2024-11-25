<?php
require 'db.php'; 
session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_usuario = $_POST['nome_usuario'];
    $senha = $_POST['senha'];

    if (empty($nome_usuario) || empty($senha)) {
        die("Por favor, preencha todos os campos.");
    }

    try {
        // Consulta para verificar o usuário
        $stmt = $pdo->prepare("SELECT id, senha, cargo FROM usuarios WHERE nome_usuario = ?");
        $stmt->execute([$nome_usuario]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($senha, $user['senha'])) {
            // Armazena dados na sessão
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['cargo'] = $user['cargo'];

            // Redireciona para o menu principal
            header("Location: ../html/menu.html");
            exit;
        } else {
            echo "Credenciais inválidas. Tente novamente.";
        }
    } catch (PDOException $e) {
        echo "Erro no banco de dados: " . $e->getMessage();
    }
} else {
    echo "Método inválido.";
}
?>
