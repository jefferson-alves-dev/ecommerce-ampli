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

// Busca as contas do banco de dados com paginação
$sql = "SELECT * FROM admins ORDER BY admin_id ASC LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':limit', $items_per_page, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$accounts = $stmt->fetchAll();

// Conta o total de contas para a paginação
$sql_count = "SELECT COUNT(*) FROM admins";
$stmt_count = $pdo->prepare($sql_count);
$stmt_count->execute();
$total_accounts = $stmt_count->fetchColumn();
$total_pages = ceil($total_accounts / $items_per_page);
?>

<div class="container mt-5">
    <h2>Gerenciar Contas</h2>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($accounts as $account): ?>
                <tr>
                    <td><?php echo htmlspecialchars($account['admin_id']); ?></td>
                    <td><?php echo htmlspecialchars($account['admin_name']); ?></td>
                    <td><?php echo htmlspecialchars($account['admin_email']); ?></td>
                    <td>
                        <a href="edit_account.php?id=<?php echo htmlspecialchars($account['admin_id']); ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="delete_account.php?id=<?php echo htmlspecialchars($account['admin_id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta conta?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <nav>
        <ul class="pagination">
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="manage_accounts.php?page=<?php echo ($page - 1); ?>">Anterior</a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="manage_accounts.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="manage_accounts.php?page=<?php echo ($page + 1); ?>">Próximo</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>