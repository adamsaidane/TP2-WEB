<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

try {
    $pdo = new PDO("mysql:host=localhost;dbname=school_db", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: sections.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM sections WHERE id = ?");
$stmt->execute([$id]);
$section = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$section) {
    header("Location: sections.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $stmt = $pdo->prepare("UPDATE sections SET name = ?,description=? WHERE id = ?");
    $stmt->execute([$name,$description, $id]);
    header("Location: sections.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une section</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Students Management System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Liste des étudiants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sections.php">Liste des sections</a>
                    </li>
                </ul>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="mb-4">Modifier une section</h1>
        <a href="sections.php" class="btn btn-secondary mb-3">Retour</a>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nom de la section</label>
                <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($section['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Modifier</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>