<?php
$conn = new mysqli("localhost", "root", "", "archeo_it");
if ($conn->connect_error) die("Erreur BDD : " . $conn->connect_error);

$sql = "SELECT titre, contenu, image_path FROM actualites ORDER BY date_pub DESC LIMIT 3";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Archéo-IT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4 text-center">Les dernières actualités</h1>
    <div class="row">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="<?= htmlspecialchars($row['image_path']) ?>" class="card-img-top" alt="Image actu">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['titre']) ?></h5>
                        <p class="card-text"><?= nl2br(htmlspecialchars($row['contenu'])) ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>
<?php $conn->close(); ?>
