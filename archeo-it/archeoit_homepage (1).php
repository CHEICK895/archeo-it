<?php
session_start();
$estConnecte = isset($_SESSION['utilisateur']); // Vérifie si l'utilisateur est connecté

// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "archeo_it");
if ($conn->connect_error) die("Erreur BDD : " . $conn->connect_error);

$pdo = new PDO('mysql:host=localhost;dbname=archeo_it', 'root', '');

// Récupération des actualités selon le statut de l'utilisateur
if ($estConnecte) {
    // Si connecté : toutes les actualités
    $stmt = $pdo->prepare("SELECT * FROM actualites ORDER BY date_pub DESC");
} else {
    // Si visiteur : seulement 3 actualités
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
    <title>Archéo-IT - L'archéologie moderne</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    
    <!-- CSS simple et facile à comprendre -->
    <style>
        /* Style pour la vidéo avec texte par dessus */
        .video-hero {
            position: relative;
            height: 550px;
            overflow: hidden;
        }
        
        .video-hero video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        /* Couche noire transparente sur la vidéo */
        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Noir à 50% de transparence */
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Texte sur la vidéo */
        .hero-text {
            text-align: center;
            color: white;
            max-width: 800px;
            padding: 20px;
        }
        
        .hero-title {
            font-size: 4rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        
        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 30px;
        }
        
        /* Section avec fond coloré */
        .section-bleue {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 0;
        }
        
        /* Section avec fond gris clair */
        .section-grise {
            background-color: #f8f9fa;
            padding: 60px 0;
        }
        
        /* Cartes avec effet au survol simple */
        .carte-hover {
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .carte-hover:hover {
            transform: translateY(-5px);
        }
        
        /* Icônes colorées */
        .icone-bleue {
            color: #667eea;
            font-size: 3rem;
        }
        
        /* Chiffres grands */
        .gros-chiffre {
            font-size: 3rem;
            font-weight: bold;
        }
        
        /* Footer sombre */
        .footer {
            background-color: #2c3e50;
            color: white;
            padding: 50px 0 20px;
        }
        
        /* Responsive simple */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            .gros-chiffre {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Menu de navigation -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-compass"></i> Archéo-IT
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav">
                    <a class="nav-link active" href="accueil.php">Accueil</a>
                    <a class="nav-link" href="chantier.html">Chantiers</a>
                    <a class="nav-link" href="contact.html">Contact</a>
                    
                    <?php if (isset($_SESSION['utilisateur'])): ?>
                        <span class="nav-link">Bonjour <?= htmlspecialchars($_SESSION['utilisateur']['nom']) ?> 👋</span>
                        <a class="nav-link" href="deconnexion.php">Déconnexion</a>
                    <?php else: ?>
                        <a class="nav-link" href="inscription.php">Inscription</a>
                        <a class="nav-link" href="connexion.php">Connexion</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Vidéo avec texte par dessus -->
    <section class="video-hero">
        <video autoplay muted loop>
            <source src="video/Generated File June 02, 2025 - 11_59AM.mp4" type="video/mp4">
        </video>
        <!-- Couche noire transparente -->
        <div class="video-overlay">
            <div class="hero-text">
                <h1 class="hero-title">Archéo-IT</h1>
                <p class="hero-subtitle">Découvrir le passé avec les technologies du futur</p>
                <a href="chantier.html" class="btn btn-light btn-lg px-4 py-2">
                    <i class="bi bi-binoculars"></i> Nos chantiers
                </a>
            </div>
        </div>
    </section>

    <!-- Section : Qui sommes-nous ? -->
    <section class="container my-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold mb-4">
                    <i class="bi bi-lightbulb text-warning"></i> Qui sommes-nous ?
                </h2>
                <p class="lead">Archéo-IT est une association française qui mélange archéologie traditionnelle et nouvelles technologies.</p>
                <p>Nous utilisons des drones, des scanners 3D et l'intelligence artificielle pour étudier les sites archéologiques avec plus de précision.</p>
                <p>Notre mission : préserver et faire découvrir l'histoire de France grâce aux outils modernes.</p>
            </div>
            <div class="col-lg-6">
                <img src="https://via.placeholder.com/600x400/667eea/ffffff?text=Archéologie+Moderne" 
                     class="img-fluid rounded shadow" alt="Archéologie moderne">
            </div>
        </div>
    </section>

    <!-- Section bleue : Chiffres de l'archéologie -->
    <section class="section-bleue">
        <div class="container">
            <h2 class="text-center mb-5 display-5 fw-bold">L'Archéologie en France</h2>
            <div class="row text-center">
                <div class="col-md-3 mb-4">
                    <div class="gros-chiffre">45,000</div>
                    <p>Sites archéologiques</p>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="gros-chiffre">2,800</div>
                    <p>Archéologues professionnels</p>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="gros-chiffre">150</div>
                    <p>Fouilles par an</p>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="gros-chiffre">49</div>
                    <p>Sites UNESCO</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section : Nos technologies -->
    <section class="container my-5">
        <h2 class="text-center display-5 fw-bold mb-5">
            <i class="bi bi-gear text-primary"></i> Nos Technologies
        </h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card carte-hover h-100 text-center p-4">
                    <i class="bi bi-robot icone-bleue mb-3"></i>
                    <h4>Intelligence Artificielle</h4>
                    <p>L'IA nous aide à analyser automatiquement les objets trouvés lors des fouilles et à identifier leur âge et leur origine.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card carte-hover h-100 text-center p-4">
                    <i class="bi bi-camera icone-bleue mb-3"></i>
                    <h4>Photogrammétrie 3D</h4>
                    <p>Nous créons des modèles 3D précis des objets et sites archéologiques pour les étudier sous tous les angles.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card carte-hover h-100 text-center p-4">
                    <i class="bi bi-drone icone-bleue mb-3"></i>
                    <h4>Drones et LiDAR</h4>
                    <p>Les drones nous permettent de cartographier les sites et de découvrir des structures cachées sous la végétation.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section grise : Histoire de l'archéologie française -->
    <section class="section-grise">
        <div class="container">
            <h2 class="text-center display-5 fw-bold mb-5">
                <i class="bi bi-clock-history text-success"></i> Dates Importantes
            </h2>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="text-primary">1940 - Grotte de Lascaux</h5>
                            <p>Découverte des célèbres peintures rupestres de Lascaux en Dordogne, vieilles de 17 000 ans.</p>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="text-primary">1994 - Grotte Chauvet</h5>
                            <p>Découverte de la grotte Chauvet avec les plus anciennes peintures du monde (36 000 ans).</p>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="text-primary">2001 - Création de l'INRAP</h5>
                            <p>Création de l'Institut National de Recherches Archéologiques Préventives pour protéger notre patrimoine.</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-primary">2020 - Archéologie numérique</h5>
                            <p>Boom des technologies numériques : IA, drones, scanners 3D révolutionnent l'archéologie.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section : Actualités (avec logique PHP) -->
    <section class="container my-5">
        <div class="row align-items-center mb-4">
            <div class="col">
                <h2 class="display-5 fw-bold">
                    <i class="bi bi-newspaper text-info"></i> Actualités
                </h2>
            </div>
            <!-- Bouton pour les visiteurs non connectés -->
            <?php if (!$estConnecte): ?>
            <div class="col-auto">
                <a href="connexion.php" class="btn btn-outline-primary">
                    Voir toutes les actualités
                </a>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- Affichage des actualités -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($actualites as $actu): ?>
            <div class="col">
                <div class="card carte-hover h-100">
                    <img src="<?= htmlspecialchars($actu['image_path']) ?>" 
                         class="card-img-top" alt="Photo actualité" 
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($actu['titre']) ?></h5>
                        <p class="card-text"><?= nl2br(htmlspecialchars($actu['contenu'])) ?></p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                            <i class="bi bi-calendar"></i> 
                            <?= date("d/m/Y", strtotime($actu['date_pub'])) ?>
                        </small>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Message pour les visiteurs -->
        <?php if (!$estConnecte && count($actualites) >= 3): ?>
        <div class="text-center mt-4">
            <p class="text-muted">
                <i class="bi bi-info-circle"></i> 
                Connectez-vous pour voir toutes nos actualités !
            </p>
        </div>
        <?php endif; ?>
    </section>

    <!-- Section : Citation -->
    <section class="section-bleue">
        <div class="container text-center">
            <blockquote class="blockquote">
                <p class="display-6 fw-light">
                    "L'archéologie est l'art de faire parler les pierres"
                </p>
                <footer class="blockquote-footer mt-3">
                    André Leroi-Gourhan, archéologue français
                </footer>
            </blockquote>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="bi bi-compass"></i> Archéo-IT</h5>
                    <p>Association française spécialisée dans l'archéologie moderne et les nouvelles technologies.</p>
                    <p><strong>Adresse :</strong> 123 Rue de l'Innovation, 75001 Paris</p>
                    <p><strong>Email :</strong> contact@archeoit.fr</p>
                </div>
                <div class="col-md-6">
                    <h5><i class="bi bi-share"></i> Nos réseaux sociaux</h5>
                    <div class="mb-3">
                        <a href="https://facebook.com/archeoit" class="text-white me-3">
                            <i class="bi bi-facebook fs-4"></i> Facebook
                        </a><br>
                        <a href="https://instagram.com/archeoit" class="text-white me-3">
                            <i class="bi bi-instagram fs-4"></i> Instagram
                        </a><br>
                        <a href="https://twitter.com/archeoit" class="text-white">
                            <i class="bi bi-twitter fs-4"></i> Twitter
                        </a>
                    </div>
                    <p><strong>Partenaires :</strong> INRAP • CNRS • Ministère de la Culture</p>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p>&copy; 2025 Archéo-IT. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript Bootstrap (obligatoire) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- JavaScript simple pour les effets -->
    <script>
        // Effet simple au survol des cartes
        document.addEventListener('DOMContentLoaded', function() {
            const cartes = document.querySelectorAll('.carte-hover');
            
            cartes.forEach(carte => {
                // Quand la souris passe sur la carte
                carte.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-10px)';
                });
                
                // Quand la souris quitte la carte
                carte.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0px)';
                });
            });
        });
    </script>
</body>
</html>