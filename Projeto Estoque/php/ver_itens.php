<?php
require 'db.php'; // Conexão com o banco de dados

try {
    // Consulta SQL para obter todos os itens
    $sql = "SELECT * FROM itens";
    $stmt = $pdo->query($sql);

    if ($stmt->rowCount() > 0) {
        $itens = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $itens = [];
    }
} catch (PDOException $e) {
    echo "Erro ao carregar os itens do estoque: " . $e->getMessage();
    exit; // Terminar a execução em caso de erro
}
?>
