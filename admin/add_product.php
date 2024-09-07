<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}
include('../server/connection.php');
include('header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $sql = "INSERT INTO products (product_name, product_price, product_description) VALUES (:name, :price, :description)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':description', $description);
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Produto adicionado com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao adicionar produto.</div>";
    }
}
?>

<div class="container mt-5">
    <h2>Adicionar Novo Produto</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label for="name" class="form-label">Nome do Produto</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Preço</label>
            <input type="number" step="0.01" id="price" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea id="description" name="description" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Adicionar Produto</button>
    </form>
</div>