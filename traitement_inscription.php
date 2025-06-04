<?php
// Récupération des données
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$password = $_POST['password']; // Ce mot de passe sera généré par le script Python

// Hash du mot de passe
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Connexion à la base
$conn = new mysqli("localhost", "root", "", "archeo_it");
if ($conn->connect_error) die("Erreur: " . $conn->connect_error);

// Requête d'insertion
$stmt = $conn->prepare("INSERT INTO users (nom, prenom, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nom, $prenom, $email, $hashed_password);

if ($stmt->execute()) {
    echo "Inscription réussie ! <a href='index.php'>Retour à l'accueil</a>";
} else {
    echo "Erreur: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
