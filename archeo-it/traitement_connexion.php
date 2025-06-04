<?php
session_start();

$pdo = new PDO("mysql:host=localhost;dbname=archeo_it", "root", "");

$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];

// Récupération de l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
$stmt->execute([$email]);
$utilisateur = $stmt->fetch();

if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
    // Connexion réussie
    $_SESSION['utilisateur'] = [
        'email' => $utilisateur['email'],
        'nom' => $utilisateur['nom']
    ];
    header("Location: accueil.php");
    exit;
} else {
    // Connexion échouée
    echo "Email ou mot de passe incorrect.";
}
