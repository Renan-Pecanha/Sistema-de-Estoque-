<?php
require 'db.php'; // Inclui a conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados do formulário
    $nome_usuario = $_POST['nome_usuario'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT); // Hash seguro da senha
    $cargo = $_POST['cargo'];

    // Validações básicas
    if (empty($nome_usuario) || empty($senha) || empty($cargo)) {
        die("Por favor, preencha todos os campos.");
    }

    try {
        // Insere o usuário na tabela
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome_usuario, senha, cargo) VALUES (?, ?, ?)");
        $stmt->execute([$nome_usuario, $senha, $cargo]);
        echo "Usuário registrado com sucesso!";
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) { // Código de erro para duplicidade
            echo "Erro: Nome de usuário já existe!";
        } else {
            echo "Erro ao registrar usuário: " . $e->getMessage();
        }
    }
} else {
    echo "Método inválido.";
}
?>
