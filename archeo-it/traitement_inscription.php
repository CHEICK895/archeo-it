<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Empêche l'accès direct au script sans formulaire
    header("Location: inscription.php");
    exit;
}

session_start();

// Récupération des données du formulaire
$email = $_POST['email'];
$nom = $_POST['nom'];
$mode = escapeshellarg($_POST['mode']);
$longueur = escapeshellarg($_POST['longueur']);

// Exécution du script Python pour générer le mot de passe
$mot_de_passe = trim(shell_exec("python3 generate_password.py $mode $longueur"));

// Vérification que le mot de passe est bien généré
if (empty($mot_de_passe) || $mot_de_passe == "INVALID") {
    die("Erreur lors de la génération du mot de passe.");
}

// Connexion à la base
$pdo = new PDO("mysql:host=localhost;dbname=archeo_it", "root", "");

// Hash du mot de passe avant enregistrement
$hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

// Insertion dans la base de données
$stmt = $pdo->prepare("INSERT INTO utilisateurs (email, mot_de_passe, nom) VALUES (?, ?, ?)");
$stmt->execute([$email, $hash, $nom]);

// Connexion automatique de l'utilisateur
$_SESSION['utilisateur'] = [
    'email' => $email,
    'nom' => $nom
];

// Stocker temporairement le mot de passe généré
$_SESSION['mot_de_passe_temporaire'] = $mot_de_passe;

// Enlever la redirection
// header("Location: confirmation_inscription.php");
// exit;

// Redirection vers la page de confirmation
header("Location: confirmation_ins.php");
exit;
?>