<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - Archéo-IT</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Inscription</h2>
    <form action="traitement_inscription.php" method="POST">
        <label>Nom: <input type="text" name="nom" required></label><br>
        <label>Prénom: <input type="text" name="prenom" required></label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <label>Mot de passe: <input type="text" name="password" required></label><br>
        <button type="submit">S’inscrire</button>
    </form>
</body>
</html>
