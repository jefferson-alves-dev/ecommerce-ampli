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

// Busca os produtos do banco de dados com paginação
$sql = "SELECT * FROM products ORDER BY product_name LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':limit', $items_per_page, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll();

// Conta o total de produtos para a paginação
$sql_count = "SELECT COUNT(*) FROM products";
$stmt_count = $pdo->prepare($sql_count);
$stmt_count->execute();
$total_products = $stmt_count->fetchColumn();
$total_pages = ceil($total_products / $items_per_page);
?>
<div class="container mt-5">
    <h2>Produtos</h2>
    <p>Total de produtos: <?php echo htmlspecialchars($total_products); ?></p>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['product_id']); ?></td>
                    <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($product['product_price']); ?></td>
                    <td><?php echo htmlspecialchars($product['product_description']); ?></td>
                    <td>
                        <a href="edit_product.php?id=<?php echo htmlspecialchars($product['product_id']); ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="edit_images.php?id=<?php echo htmlspecialchars($product['product_id']); ?>" class="btn btn-info btn-sm">Editar Imagens</a>
                        <a href="delete_product.php?id=<?php echo htmlspecialchars($product['product_id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir</a>

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
                    <a class="page-link" href="list_products.php?page=1">Primeiro</a>
                </li>
            <?php endif; ?>

            <!-- Botão "Anterior" -->
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="list_products.php?page=<?php echo ($page - 1); ?>">Anterior</a>
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
                    <a class="page-link" href="list_products.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($end_page < $total_pages): ?>
                <li class="page-item disabled"><span class="page-link">...</span></li>
            <?php endif; ?>

            <!-- Botão "Próximo" -->
            <?php if ($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="list_products.php?page=<?php echo ($page + 1); ?>">Próximo</a>
                </li>
            <?php endif; ?>

            <!-- Botão "Último" -->
            <?php if ($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="list_products.php?page=<?php echo $total_pages; ?>">Último</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<!-- Modal de Confirmação -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Você tem certeza que deseja excluir este produto?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="post" action="delete_product.php">
                    <input type="hidden" name="id" id="productId">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script para manipulação do modal -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteButtons = document.querySelectorAll('button[data-bs-target="#confirmDeleteModal"]');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var productId = button.getAttribute('data-product-id');
                document.getElementById('productId').value = productId;
            });
        });
    });
</script>