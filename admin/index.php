<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}
include('../server/connection.php');
include('header.php');

// Configurações de paginação
$items_per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;

// Busca os pedidos do banco de dados com paginação
$sql = "SELECT * FROM orders ORDER BY order_date DESC LIMIT ? OFFSET ?";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(1, $items_per_page, PDO::PARAM_INT);
$stmt->bindParam(2, $offset, PDO::PARAM_INT);
$stmt->execute();
$orders = $stmt->fetchAll();

// Conta o total de pedidos para a paginação
$sql_count = "SELECT COUNT(*) FROM orders";
$stmt_count = $pdo->prepare($sql_count);
$stmt_count->execute();
$total_orders = $stmt_count->fetchColumn();
$total_pages = ceil($total_orders / $items_per_page);
?>
<div class="container mt-5">
    <h2>Pedidos</h2>
    <p>Total de pedidos: <?php echo htmlspecialchars($total_orders); ?></p>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Custo</th>
                <th>Status</th>
                <th>Usuário ID</th>
                <th>Cidade de Envio</th>
                <th>UF</th>
                <th>Endereço de Envio</th>
                <th>Data do Pedido</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                    <td><?php echo htmlspecialchars($order['order_cost']); ?></td>
                    <td><?php echo htmlspecialchars($order['order_status']); ?></td>
                    <td><?php echo htmlspecialchars($order['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($order['shipping_city']); ?></td>
                    <td><?php echo htmlspecialchars($order['shipping_uf']); ?></td>
                    <td><?php echo htmlspecialchars($order['shipping_address']); ?></td>
                    <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                    <td>
                        <a href="edit_order.php?id=<?php echo htmlspecialchars($order['order_id']); ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="delete_order.php?id=<?php echo htmlspecialchars($order['order_id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este pedido?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <nav>
        <ul class="pagination">
            <!-- Botão "Primeiro" -->
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?page=1">Primeiro</a>
                </li>
            <?php endif; ?>

            <!-- Botão "Anterior" -->
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?page=<?php echo ($page - 1); ?>">Anterior</a>
                </li>
            <?php endif; ?>

            <!-- Números das páginas -->
            <?php
            $start_page = max(1, $page - 2);
            $end_page = min($total_pages, $page + 2);

            if ($start_page > 1): ?>
                <li class="page-item disabled"><span class="page-link">...</span></li>
            <?php endif; ?>

            <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($end_page < $total_pages): ?>
                <li class="page-item disabled"><span class="page-link">...</span></li>
            <?php endif; ?>

            <!-- Botão "Próximo" -->
            <?php if ($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?page=<?php echo ($page + 1); ?>">Próximo</a>
                </li>
            <?php endif; ?>

            <!-- Botão "Último" -->
            <?php if ($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?page=<?php echo $total_pages; ?>">Último</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<?php
include('footer.php');
?>