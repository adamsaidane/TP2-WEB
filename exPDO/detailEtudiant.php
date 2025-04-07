<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

try {
    $pdo = new PDO("mysql:host=localhost;dbname=school_db", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID invalide");
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT students.*, sections.name AS section_name FROM students LEFT JOIN sections ON students.section_id = sections.id WHERE students.id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    die("Étudiant non trouvé");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'étudiant</title>
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
        <h1 class="mb-4">Détails de l'étudiant</h1>
        <div class="card">
            <div class="card-body">
                <p class="card-text"><strong>ID :</strong> <?php echo htmlspecialchars($student['id']); ?></p>
                <p class="card-text"><strong>Nom :</strong> <?php echo htmlspecialchars($student['name']); ?></p>
                <p class="card-text"><strong>Date de naissance :</strong> <?php echo htmlspecialchars($student['birthday']); ?></p>
                <p class="card-text"><strong>Section :</strong> <?php echo htmlspecialchars($student['section_name'] ?? 'Aucune section'); ?></p>
                <p class="card-text"><strong>Image :</strong></p>
                <?php if ($student['image']): ?>
                    <img src="<?php echo htmlspecialchars($student['image']); ?>" alt="Image" class="img-thumbnail mb-2" width="100">
                <?php else: ?>
                    <p>Aucune image</p>
                <?php endif; ?>
            </div>
        </div>
        <a href="index.php" class="btn btn-secondary mt-3">Retour à la liste</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>