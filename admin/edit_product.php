<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}
include('../server/connection.php');
include('header.php');

$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE product_id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$product = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $sql = "UPDATE products SET product_name = :name, product_price = :price, product_description = :description WHERE product_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Produto atualizado com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao atualizar produto.</div>";
    }
}
?>

<div class="container mt-5">
    <h2>Editar Produto</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label for="name" class="form-label">Nome do Produto</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Preço</label>
            <input type="number" step="0.01" id="price" name="price" class="form-control" value="<?php echo htmlspecialchars($product['product_price']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea id="description" name="description" class="form-control" rows="3" required><?php echo htmlspecialchars($product['product_description']); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Produto</button>
    </form>
</div>