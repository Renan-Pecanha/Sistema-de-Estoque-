<?php
require 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $fornecedor = $_POST['fornecedor'];
    $quantidade = $_POST['quantidade'];
    $lote = $_POST['lote'];
    $data_registro = date('d-m-y H:i:s'); // Data e hora atual
    $data_registro_entrada = $_POST['data_registro_entrada']; 
    $registrado_por = $_POST['registrado_por'];

    try {
        $sql = "INSERT INTO itens (nome, tipo, fornecedor, quantidade, lote, data_registro, data_registro_entrada, registrado_por) 
                VALUES (:nome, :tipo, :fornecedor, :quantidade, :lote, :data_registro, :data_registro_entrada, :registrado_por)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':tipo' => $tipo,
            ':fornecedor' => $fornecedor,
            ':quantidade' => $quantidade,
            ':lote' => $lote,
            ':data_registro' => $data_registro,
            ':data_registro_entrada' => $data_registro_entrada,
            ':registrado_por' => $registrado_por
        ]);

        echo "Item cadastrado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao cadastrar item: " . $e->getMessage();
    }
}
