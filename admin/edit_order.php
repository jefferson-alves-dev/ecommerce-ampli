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

// Busca os dados do pedido
$sql = "SELECT * FROM orders WHERE order_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$order_id]);
$order = $stmt->fetch();

if (!$order) {
    die('Pedido não encontrado.');
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['order_status'];

    if (in_array($status, ['on_hold', 'paid', 'shipped', 'delivered'])) {
        // Atualiza o status do pedido
        $sql_update = "UPDATE orders SET order_status = ? WHERE order_id = ?";
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->execute([$status, $order_id]);

        // Redireciona de volta para a lista de pedidos
        header('Location: index.php');
        exit();
    } else {
        $error_message = 'Status inválido.';
    }
}
?>

<div class="container mt-5">
    <h2>Editar Pedido</h2>

    <form method="POST" action="">
        <div class="form-group mb-3">
            <label for="order_status">Status do Pedido</label>
            <select id="order_status" name="order_status" class="form-control" required>
                <option value="on_hold" <?php echo ($order['order_status'] == 'on_hold') ? 'selected' : ''; ?>>Em análise</option>
                <option value="paid" <?php echo ($order['order_status'] == 'paid') ? 'selected' : ''; ?>>Pago</option>
                <option value="shipped" <?php echo ($order['order_status'] == 'shipped') ? 'selected' : ''; ?>>Enviado</option>
                <option value="delivered" <?php echo ($order['order_status'] == 'delivered') ? 'selected' : ''; ?>>Entregue</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>

    <!-- Exibe a mensagem de erro, se houver -->
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger mt-4" role="alert">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>
</div>