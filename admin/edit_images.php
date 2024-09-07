<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}
include('../server/connection.php');
include('header.php');

$id = $_GET['id'];

// Lógica para upload de novas imagens
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['images'])) {
        $files = $_FILES['images'];
        $upload_dir = '../uploads/';

        foreach ($files['tmp_name'] as $key => $tmp_name) {
            $file_name = basename($files['name'][$key]);
            $upload_file = $upload_dir . $file_name;

            if (move_uploaded_file($tmp_name, $upload_file)) {
                $sql = "INSERT INTO product_images (product_id, image_path) VALUES (:product_id, :image_path)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':product_id', $id);
                $stmt->bindParam(':image_path', $upload_file);
                $stmt->execute();
            }
        }
        echo "<div class='alert alert-success'>Imagens atualizadas com sucesso!</div>";
    }
}

$sql = "SELECT * FROM product_images WHERE product_id = :product_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':product_id', $id);
$stmt->execute();
$images = $stmt->fetchAll();
?>

<div class="container mt-5">
    <h2>Editar Imagens do Produto</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="images" class="form-label">Selecionar Imagens</label>
            <input type="file" id="images" name="images[]" class="form-control" multiple>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Imagens</button>
    </form>

    <h3 class="mt-4">Imagens Atuais</h3>
    <div class="row">
        <?php foreach ($images as $image): ?>
            <div class="col-md-3">
                <img src="<?php echo htmlspecialchars($image['image_path']); ?>" class="img-fluid" alt="Image">
            </div>
        <?php endforeach; ?>
    </div>
</div>