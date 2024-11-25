<?php
require_once 'db.php';

try {
    $sql = "SELECT id, nome FROM itens";
    $stmt = $pdo->query($sql);
    $itens = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($itens as $item) {
        echo "<option value='{$item['id']}'>{$item['nome']}</option>";
    }
} catch (PDOException $e) {
    echo "Erro ao carregar itens: " . $e->getMessage();
}
