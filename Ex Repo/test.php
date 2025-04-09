<?php

require_once 'Repository.php';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=school_db", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$sectionRepo = new Repository($pdo, 'sections');

echo "<h1>Sections</h1>";

echo "<h2>Find All Sections</h2>";
$sections = $sectionRepo->findAll();
foreach ($sections as $section) {
    echo "ID: {$section['id']}, Name: {$section['name']}, Description: {$section['description']}<br>";
}

echo "<h2>Find Section by ID (ID: 2)</h2>";
$section = $sectionRepo->findById(2);
if ($section) {
    echo "Found Section - ID: {$section['id']}, Name: {$section['name']}, Description: {$section['description']}<br>";
} else {
    echo "Section not found.<br>";
}

echo "<h2>Create a New Section</h2>";
$newSectionData = [
    'name' => 'IMI',
    'description' => 'Instrumentation et Maintenance Industrielle'
];
$newSectionId = $sectionRepo->create($newSectionData);
echo "New Section created with ID: $newSectionId<br>";

$newSection = $sectionRepo->findById($newSectionId);
if ($newSection) {
    echo "Verified New Section - ID: {$newSection['id']}, Name: {$newSection['name']}, Description: {$newSection['description']}<br>";
}

echo "<h2>Delete Section (ID: $newSectionId)</h2>";
if ($sectionRepo->delete($newSectionId)) {
    echo "Section with ID $newSectionId deleted successfully.<br>";
} else {
    echo "Failed to delete section.<br>";
}


$userRepo = new Repository($pdo, 'users');

echo "<h1>Users</h1>";

echo "<h2>Find All Users</h2>";
$users = $userRepo->findAll();
foreach ($users as $user) {
    echo "ID: {$user['id']}, Username: {$user['username']}, Email: {$user['email']}, Role: {$user['role']}<br>";
}

echo "<h2>Find User by ID (ID: 1)</h2>";
$user = $userRepo->findById(1);
if ($user) {
    echo "Found User - ID: {$user['id']}, Username: {$user['username']}, Email: {$user['email']}, Role: {$user['role']}<br>";
} else {
    echo "User not found.<br>";
}

echo "<h2>Create a New User</h2>";
$newUserData = [
    'username' => 'newuser',
    'email' => 'newuser@example.com',
    'password' => 'newuser123',
    'role' => 'user'
];
$newUserId = $userRepo->create($newUserData);
echo "New User created with ID: $newUserId<br>";

$newUser = $userRepo->findById($newUserId);
if ($newUser) {
    echo "Verified New User - ID: {$newUser['id']}, Username: {$newUser['username']}, Email: {$newUser['email']}, Role: {$newUser['role']}<br>";
}

echo "<h2>Delete User (ID: $newUserId)</h2>";
if ($userRepo->delete($newUserId)) {
    echo "User with ID $newUserId deleted successfully.<br>";
} else {
    echo "Failed to delete user.<br>";
}
