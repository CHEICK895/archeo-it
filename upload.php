<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une actualité</title>
</head>
<body>
    <h2>Ajouter une nouvelle actualité</h2>
    <form action="upload_traitement.php" method="POST" enctype="multipart/form-data">
        <label>Titre : <input type="text" name="titre" required></label><br><br>
        <label>Contenu :<br><textarea name="contenu" rows="4" cols="50" required></textarea></label><br><br>
        <label>Image : <input type="file" name="image" accept="image/*" required></label><br><br>
        <button type="submit">Publier</button>
    </form>
</body>
</html>
