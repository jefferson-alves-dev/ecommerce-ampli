<?php
session_start();
include('../server/connection.php');
if (isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}
include('header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $sql = "SELECT * FROM admins WHERE admin_email = ? LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $admin = $stmt->fetch();

        if ($admin && md5($password) === $admin['admin_password']) {
            $_SESSION['admin_id'] = $admin['admin_id'];
            $_SESSION['admin_name'] = $admin['admin_name'];
            $_SESSION['admin_email'] = $admin['admin_email'];


            header('Location: index.php');
            exit();
        } else {
            $error_message = 'Usuário ou senha inválidos.';
        }
    } else {
        $error_message = 'Preencha todos os campos.';
    }
}
?>

<div class="container mt-5 d-flex justify-content-center">
    <div class="col-md-6 col-lg-4">
        <form method="POST" action="login.php">
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required />
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" id="password" name="password" class="form-control" required />
                <label class="form-label" for="password">Password</label>
            </div>

            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Login</button>
        </form>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger mt-4" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
    </div>
</div>