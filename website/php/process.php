<?php

require_once 'app/init.php';

// Get POST data
$first = (!empty($_POST['Nom']) ? $_POST['Nom'] : '');
$last = (!empty($_POST['Prenom']) ? $_POST['Prenom'] : '');
$email = (!empty($_POST['Email']) ? $_POST['Email'] : '');

// Set SQL
$sql = 'INSERT INTO users (nom, prenom, email) VALUES (:first, :last, :email)';

// Prepare query
$query = $db->prepare($sql);

// Execute query
$query->execute(array(':first' => $first, ':last' => $last, ':email' => $email));
    
$userQuery = $db->prepare("
    SELECT id
    FROM users
    WHERE nom = :nom AND prenom = :prenom AND email = :email
");

$userQuery->execute([
    'nom' => $first,
    'prenom' => $last,
    'email' => $email
]);
