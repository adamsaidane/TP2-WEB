<?php
include 'Student.php';

$aymen = new Student("Aymen", [11, 13, 18, 7, 10, 13, 2, 5, 1]);
$skander = new Student("Skander", [15, 9, 8, 16]);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Notes Étudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">
    <div class="container">
        <div class="container">
        <h2 class="mb-4">Résultat des étudiants</h2>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header fw-bold"><?= $aymen->name ?></div>
                    <div class="card-body">
                        <?php $aymen->displayGrades(); ?>
                        <div class="mt-3 alert alert-primary">Votre moyenne est <?= $aymen->average() ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header fw-bold"><?= $skander->name ?></div>
                    <div class="card-body">
                        <?php $skander->displayGrades(); ?>
                        <div class="mt-3 alert alert-primary">Votre moyenne est <?= $skander->average() ?></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
