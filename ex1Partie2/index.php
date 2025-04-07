<?php
include 'SessionManager.php';

$session = new SessionManager();
if (isset($_GET['reset'])) {
    $session->reset();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Session</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">
    <div class="container"> 
        <div class="mb-4">
            <h2 class="mb-3">Message de Session</h2>
            <div class="alert alert-info">
                <?php echo $session->getMessage(); ?>
            </div>
            <a href="?reset=true" class="btn btn-outline-danger">Réinitialiser la session</a>
        </div>
    </div>
</body>
</html>
