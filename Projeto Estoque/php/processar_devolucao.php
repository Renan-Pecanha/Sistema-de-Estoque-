<?php
require_once 'db.php';

$item_id = $_POST['item_id'];
$quantidade = $_POST['quantidade'];
$responsavel = $_POST['responsavel'];

try {
    // Aumenta a quantidade no estoque
    $sql = "UPDATE itens SET quantidade = quantidade + :quantidade WHERE id = :item_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['quantidade' => $quantidade, 'item_id' => $item_id]);

    // Insere a movimentação
    $sql = "INSERT INTO movimentacoes (item_id, tipo, quantidade, responsavel) VALUES (:item_id, 'devolucao', :quantidade, :responsavel)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['item_id' => $item_id, 'quantidade' => $quantidade, 'responsavel' => $responsavel]);

    echo "Devolução registrada com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao processar devolução: " . $e->getMessage();
}
