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

$stmt = $pdo->prepare("SELECT id FROM sections WHERE id = ?");
$stmt->execute([$id]);
$section = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$section) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("DELETE FROM sections WHERE id = ?");
$stmt->execute([$id]);

header("Location: sections.php");
exit;
?>