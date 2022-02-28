<?php

session_start();

$db_username = 'root';
$db_password = '';

try {
    $db = new PDO('mysql:host=localhost;dbname=pollwebsite', $db_username, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    $e->getMessage();
}