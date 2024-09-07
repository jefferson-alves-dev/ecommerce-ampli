<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}
include('header.php');
include('../server/connection.php');

if (isset($_GET['id'])) {
    $admin_id = (int)$_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Atualiza os dados do usuário
        $sql = "UPDATE admins SET admin_name = :name, admin_email = :email" . (!empty($password) ? ", admin_password = :password" : "") . " WHERE admin_id = :admin_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':admin_id', $admin_id);

        if (!empty($password)) {
            $hashed_password = md5($password); // Usando MD5 para hash da senha
            $stmt->bindParam(':password', $hashed_password);
        }

        try {
            $stmt->execute();
            header('Location: account.php');
            exit();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    $sql = "SELECT * FROM admins WHERE admin_id = :admin_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':admin_id', $admin_id);
    $stmt->execute();
    $account = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Conta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Editar Conta</h2>
        <form method="POST" action="edit_account.php?id=<?php echo htmlspecialchars($admin_id); ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($account['admin_name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($account['admin_email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha (deixe em branco para não alterar)</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>