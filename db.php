<?php
$host = 'localhost';         // serveur local
$db   = 'archéologie';       // ton nom de base de données
$user = 'root';              // nom d'utilisateur par défaut sur XAMPP/MAMP
$pass = '';                  // mot de passe vide (sur XAMPP, sinon ajuste)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    // Active les erreurs PDO (très utile pour debug)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
