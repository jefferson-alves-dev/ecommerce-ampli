<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

include('../server/connection.php');

if (isset($_GET['id'])) {
    $product_id = (int)$_GET['id'];

    try {
        // Iniciar a transação
        $pdo->beginTransaction();

        // Primeiro, exclua todas as imagens associadas ao produto
        $sql_images = "DELETE FROM product_images WHERE product_id = :product_id";
        $stmt_images = $pdo->prepare($sql_images);
        $stmt_images->bindParam(':product_id', $product_id);
        $stmt_images->execute();

        // Em seguida, exclua o produto
        $sql_product = "DELETE FROM products WHERE product_id = :product_id";
        $stmt_product = $pdo->prepare($sql_product);
        $stmt_product->bindParam(':product_id', $product_id);
        $stmt_product->execute();

        // Confirmar a transação
        $pdo->commit();

        header('Location: list_products.php');
        exit();
    } catch (PDOException $e) {
        // Reverter a transação em caso de erro
        $pdo->rollBack();
        echo "Erro: " . $e->getMessage();
    }
}
