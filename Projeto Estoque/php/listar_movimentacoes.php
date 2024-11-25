<?php
require_once 'db.php';

try {
    // Consulta para buscar as movimentações com os nomes dos itens
    $sql = "
        SELECT 
            movimentacoes.id,
            itens.nome AS item_nome,
            movimentacoes.tipo,
            movimentacoes.quantidade,
            movimentacoes.responsavel,
            movimentacoes.data_operacao
        FROM movimentacoes
        JOIN itens ON movimentacoes.item_id = itens.id
        ORDER BY movimentacoes.data_operacao DESC
    ";
    $stmt = $pdo->query($sql);
    $movimentacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($movimentacoes as $mov) {
        echo "
            <tr>
                <td>{$mov['id']}</td>
                <td>{$mov['item_nome']}</td>
                <td>{$mov['tipo']}</td>
                <td>{$mov['quantidade']}</td>
                <td>{$mov['responsavel']}</td>
                <td>{$mov['data_operacao']}</td>
            </tr>
        ";
    }
} catch (PDOException $e) {
    echo "<tr><td colspan='6'>Erro ao carregar movimentações: " . $e->getMessage() . "</td></tr>";
}
