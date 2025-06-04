 <?php
session_start();
$estConnecte = isset($_SESSION['utilisateur']); // change si ton système utilise autre chose

// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "archeo_it");
if ($conn->connect_error) die("Erreur BDD : " . $conn->connect_error);

$pdo = new PDO('mysql:host=localhost;dbname=archeo_it', 'root', '');

// Préparation de la requête
if ($estConnecte) {
    $stmt = $pdo->prepare("SELECT * FROM actualites ORDER BY date_pub DESC");
} else {
    $stmt = $pdo->prepare("SELECT * FROM actualites ORDER BY date_pub DESC LIMIT 3");
}

$stmt->execute();
$actualites = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="accueil.css">
</head>
<body>
     <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Menu</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="accueil.php">Accueil</a>
        <a class="nav-link" href="chantier.html">Chantier</a>
        <a class="nav-link" href="contact.html">Contact</a>
      <?php if (isset($_SESSION['utilisateur'])): ?>
    <span class="nav-link disabled">Bienvenue, <?= htmlspecialchars($_SESSION['utilisateur']['nom']) ?> 👋</span>
    <a class="nav-link" href="deconnexion.php">Déconnexion</a>
<?php else: ?>
    <a class="nav-link" href="inscription.php">Inscription</a>
    <a class="nav-link" href="connexion.php">Connexion</a>
<?php endif; ?>

        <a class="nav-link disabled" aria-disabled="true"></a>
      </div>
    </div>
  </div>
</nav>
  <header>
  <video autoplay muted loop style="width: 100%; height: 550px; object-fit: cover;">
  <source src="video/Generated File June 02, 2025 - 11_59AM.mp4" type="video/mp4">
</video>
</header>
<h1>Bienvenue chez Archéo-IT</h1>
<h2>Explorez le passé avec les technologies du futur </h2>

<a href="chantier.html" class="btn">Découvrez nos chantiers</a>
        <!-- Actualités -->
<div class="container mt-5">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($actualites as $actu): ?>
        <div class="col">
            <div class="card h-100">
                <img src="<?= htmlspecialchars($actu['image_path']) ?>" class="card-img-top" alt="Image actu">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($actu['titre']) ?></h5>
                    <p class="card-text"><?= nl2br(htmlspecialchars($actu['contenu'])) ?></p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Publié le <?= date("d/m/Y", strtotime($actu['date_pub'])) ?></small>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>


<p> <style>p { text-align: center; }</style><br>L’archéologie française, riche et dynamique, s’appuie sur une longue tradition de recherche et des institutions prestigieuses comme l’INRAP (archéologie préventive) et le CNRS. <br> Elle couvre toutes les périodes, des grottes ornées de Lascaux et Chauvet à l’Antiquité gallo-romaine (Alésia, Vix) en passant par le Moyen Âge. <br> La France innove avec des techniques de pointe (lidar, ADN ancien) et excelle en archéologie sous-marine. <br> Les enjeux actuels incluent la protection du patrimoine, la restitution d’objets et la médiation culturelle (ex : Journées nationales de l'archéologie). <br> Leader mondial, elle allie recherche scientifique et valorisation du passé.</p>
 <div class="card h-100">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text"><a href="https://archeologie.culture.gouv.fr/france/fr/larcheologie-francaise">Le saviez vous ? cliquez ici pour en decouvrir d'avantage</a>.</p>
      </div>
      <div class="card-footer">
        <small class="text-body-secondary">Last updated 3 mins ago</small>
      </div>
    </div>
  </div>
</div>
<footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="foot"></i> Archéo-IT</h5>
                    <p>Association dédiée à l'archéologie moderne et aux nouvelles technologies.</p>
                </div>
            </div>
             <div class="col-md-6">
                <h3>Suivez-nous</h3>
                <ul class="reseau">
                    <li><a href="https://facebook.com/votresite" target="_blank">Facebook</a></li>
                    <li><a href="https://twitter.com/votresite" target="_blank">Twitter</a></li>
                    <li><a href="https://instagram.com/votresite" target="_blank">Instagram</a></li>
                    <li><a href="https://linkedin.com/in/votresite" target="_blank">LinkedIn</a></li>
                </ul>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p>&copy; 2025 Archéo-IT. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>

