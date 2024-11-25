<?php
require 'db.php'; // Inclui a conexão com o banco de dados


ob_start();
header('Content-Type: application/json');

try {
    $sql = "SELECT * FROM itens";
    $stmt = $pdo->query($sql);

    if ($stmt->rowCount() > 0) {
        $itens = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['success' => true, 'data' => $itens]);
    } else {
        echo json_encode(['success' => true, 'data' => []]);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

// Finaliza e limpa o buffer de saída
ob_end_flush();
