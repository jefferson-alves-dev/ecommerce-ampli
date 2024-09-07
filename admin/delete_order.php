<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}
include('../server/connection.php');
include('header.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('ID do pedido inválido.');
}

$order_id = (int)$_GET['id'];

// Exclui o pedido
$sql_delete = "DELETE FROM orders WHERE order_id = ?";
$stmt_delete = $pdo->prepare($sql_delete);
$stmt_delete->execute([$order_id]);

// Redireciona para a lista de pedidos
header('Location: index.php');
exit();
