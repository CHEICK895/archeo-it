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
    <title>Archéo-IT - L'archéologie à l'ère du numérique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        .hero-section {
            position: relative;
            overflow: hidden;
            height: 550px;
        }
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
        }
        .hero-content {
            text-align: center;
            color: white;
            max-width: 800px;
            padding: 0 20px;
        }
        .hero-title {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
        }
        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.7);
        }
        .stats-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4rem 0;
            margin: 3rem 0;
        }
        .stat-item {
            text-align: center;
            padding: 1rem;
        }
        .stat-number {
            font-size: 3rem;
            font-weight: bold;
            display: block;
        }
        .timeline-section {
            background-color: #f8f9fa;
            padding: 4rem 0;
        }
        .timeline-item {
            border-left: 4px solid #667eea;
            padding-left: 2rem;
            margin-bottom: 2rem;
            position: relative;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -8px;
            top: 0;
            width: 12px;
            height: 12px;
            background: #667eea;
            border-radius: 50%;
        }
        .feature-card {
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }
        .tech-icon {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 1rem;
        }
        .news-section {
            background: white;
            padding: 4rem 0;
        }
        .quote-section {
            background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 4rem 0;
            text-align: center;
        }
        .footer {
            background-color: #2c3e50;
            color: white;
            padding: 3rem 0 1rem;
        }
        
        /* Animations CSS personnalisées */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }
        
        /* Effet de brillance sur les boutons */
        .btn-primary, .btn-light {
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary::before, .btn-light::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }
        
        .btn-primary:hover::before, .btn-light:hover::before {
            left: 100%;
        }
        
        /* Responsive amélioré */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            .hero-subtitle {
                font-size: 1.2rem;
            }
            .stat-number {
                font-size: 2rem;
            }
            .tech-icon {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#"><i class="bi bi-compass"></i> Archéo-IT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="accueil.php">Accueil</a>
                    <a class="nav-link" href="chantier.html">Chantiers</a>
                    <a class="nav-link" href="contact.html">Contact</a>
                    <?php if (isset($_SESSION['utilisateur'])): ?>
                        <span class="nav-link disabled">Bienvenue, <?= htmlspecialchars($_SESSION['utilisateur']['nom']) ?> 👋</span>
                        <a class="nav-link" href="deconnexion.php">Déconnexion</a>
                    <?php else: ?>
                        <a class="nav-link" href="inscription.php">Inscription</a>
                        <a class="nav-link" href="connexion.php">Connexion</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Section Hero -->
    <section class="hero-section">
        <video autoplay muted loop style="width: 100%; height: 100%; object-fit: cover;">
            <source src="video/Generated File June 02, 2025 - 11_59AM.mp4" type="video/mp4">
        </video>
        <div class="hero-overlay">
            <div class="hero-content">
                <h1 class="hero-title">Archéo-IT</h1>
                <p class="hero-subtitle">Révéler le passé grâce aux technologies du futur</p>
                <a href="chantier.html" class="btn btn-light btn-lg px-4 py-2">
                    <i class="bi bi-binoculars"></i> Découvrez nos chantiers
                </a>
            </div>
        </div>
    </section>

    <!-- Section Mission -->
    <section class="container my-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold mb-4">
                    <i class="bi bi-lightbulb text-warning"></i> Notre Mission
                </h2>
                <p class="lead">Archéo-IT est une association pionnière qui révolutionne l'archéologie française en intégrant les technologies les plus avancées à la recherche historique.</p>
                <p>Nous utilisons l'intelligence artificielle, la photogrammétrie 3D, les drones et l'analyse de données pour découvrir, documenter et préserver notre patrimoine archéologique avec une précision inégalée.</p>
                <div class="d-flex gap-3 mt-4">
                    <div class="text-center">
                        <i class="bi bi-cpu tech-icon"></i>
                        <h6>IA & Machine Learning</h6>
                    </div>
                    <div class="text-center">
                        <i class="bi bi-camera tech-icon"></i>
                        <h6>Photogrammétrie</h6>
                    </div>
                    <div class="text-center">
                        <i class="bi bi-drone tech-icon"></i>
                        <h6>Cartographie Drone</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="https://via.placeholder.com/600x400/667eea/ffffff?text=Technologies+Archéologiques" 
                     class="img-fluid rounded shadow" alt="Technologies archéologiques">
            </div>
        </div>
    </section>

    <!-- Section Statistiques -->
    <section class="stats-section">
        <div class="container">
            <h2 class="text-center mb-5 display-5 fw-bold">L'Archéologie Française en Chiffres</h2>
            <div class="row">
                <div class="col-md-3 stat-item">
                    <span class="stat-number">45,000</span>
                    <span>Sites archéologiques répertoriés</span>
                </div>
                <div class="col-md-3 stat-item">
                    <span class="stat-number">2,800</span>
                    <span>Archéologues professionnels</span>
                </div>
                <div class="col-md-3 stat-item">
                    <span class="stat-number">150</span>
                    <span>Fouilles programmées/an</span>
                </div>
                <div class="col-md-3 stat-item">
                    <span class="stat-number">8</span>
                    <span>Millions d'objets conservés</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Technologies -->
    <section class="container my-5">
        <h2 class="text-center display-5 fw-bold mb-5">
            <i class="bi bi-gear-wide-connected text-primary"></i> Nos Technologies de Pointe
        </h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card feature-card h-100 text-center p-4">
                    <i class="bi bi-robot tech-icon"></i>
                    <h4>Intelligence Artificielle</h4>
                    <p>Analyse automatique des artefacts, reconnaissance de motifs et classification des découvertes grâce au deep learning.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card h-100 text-center p-4">
                    <i class="bi bi-box tech-icon"></i>
                    <h4>Modélisation 3D</h4>
                    <p>Reconstitution virtuelle précise des sites et objets archéologiques pour une documentation complète.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card h-100 text-center p-4">
                    <i class="bi bi-radar tech-icon"></i>
                    <h4>Prospection LiDAR</h4>
                    <p>Détection de structures enfouies et cartographie haute résolution des sites archéologiques.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Actualités -->
    <section class="news-section">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col">
                    <h2 class="display-5 fw-bold">
                        <i class="bi bi-newspaper text-info"></i> Actualités Archéologiques
                    </h2>
                </div>
                <?php if (!$estConnecte): ?>
                <div class="col-auto">
                    <a href="connexion.php" class="btn btn-outline-primary">
                        <i class="bi bi-unlock"></i> Voir toutes les actualités
                    </a>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($actualites as $actu): ?>
                <div class="col">
                    <div class="card h-100 feature-card">
                        <img src="<?= htmlspecialchars($actu['image_path']) ?>" class="card-img-top" alt="Image actualité" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($actu['titre']) ?></h5>
                            <p class="card-text"><?= nl2br(htmlspecialchars($actu['contenu'])) ?></p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">
                                <i class="bi bi-calendar-event"></i> 
                                Publié le <?= date("d/m/Y", strtotime($actu['date_pub'])) ?>
                            </small>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <?php if (!$estConnecte && count($actualites) >= 3): ?>
            <div class="text-center mt-4">
                <p class="text-muted">
                    <i class="bi bi-info-circle"></i> 
                    Connectez-vous pour accéder à toutes nos actualités archéologiques
                </p>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Chronologie de l'archéologie française -->
    <section class="timeline-section">
        <div class="container">
            <h2 class="text-center display-5 fw-bold mb-5">
                <i class="bi bi-clock-history text-success"></i> Chronologie de l'Archéologie Française
            </h2>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="timeline-item">
                        <h4 class="text-primary">1940 - Découverte de Lascaux</h4>
                        <p>Découverte accidentelle de la grotte de Lascaux en Dordogne, révélant des peintures rupestres exceptionnelles datant du Paléolithique supérieur.</p>
                    </div>
                    <div class="timeline-item">
                        <h4 class="text-primary">1961 - Création du CNRS</h4>
                        <p>Création du Centre National de la Recherche Scientifique, structurant la recherche archéologique française.</p>
                    </div>
                    <div class="timeline-item">
                        <h4 class="text-primary">1994 - Grotte Chauvet</h4>
                        <p>Découverte de la grotte Chauvet-Pont-d'Arc, abritant les plus anciennes peintures rupestres connues (36 000 ans).</p>
                    </div>
                    <div class="timeline-item">
                        <h4 class="text-primary">2001 - Création de l'INRAP</h4>
                        <p>Fondation de l'Institut National de Recherches Archéologiques Préventives, révolutionnant l'archéologie préventive en France.</p>
                    </div>
                    <div class="timeline-item">
                        <h4 class="text-primary">2020 - Archéologie numérique</h4>
                        <p>Développement massif des technologies numériques en archéologie : IA, drones, modélisation 3D et bases de données partagées.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Citation inspirante -->
    <section class="quote-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <blockquote class="blockquote text-center">
                        <p class="display-6 fw-light mb-4">
                            <i class="bi bi-quote"></i>
                            L'archéologie est l'art de ressusciter les morts et de faire parler les pierres
                            <i class="bi bi-quote"></i>
                        </p>
                        <footer class="blockquote-footer mt-3">
                            <cite title="Source Title">André Leroi-Gourhan, préhistorien français</cite>
                        </footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    <!-- Informations complémentaires -->
    <section class="container my-5">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card feature-card h-100">
                    <img src="https://via.placeholder.com/400x250/28a745/ffffff?text=Patrimoine+UNESCO" class="card-img-top" alt="Sites UNESCO">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-gem text-warning"></i> Sites UNESCO Français
                        </h5>
                        <p class="card-text">La France compte 49 sites inscrits au patrimoine mondial de l'UNESCO, témoignant de la richesse exceptionnelle de son patrimoine archéologique et historique.</p>
                        <a href="https://archeologie.culture.gouv.fr/france/fr/larcheologie-francaise" class="btn btn-outline-success" target="_blank">
                            <i class="bi bi-link-45deg"></i> En savoir plus
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card feature-card h-100">
                    <img src="https://via.placeholder.com/400x250/dc3545/ffffff?text=Innovations+Technologiques" class="card-img-top" alt="Innovations">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-rocket text-primary"></i> Innovations Archéo-IT
                        </h5>
                        <p class="card-text">Nos dernières innovations incluent l'utilisation de l'ADN ancien, l'analyse isotopique et la datation par luminescence pour révéler les secrets du passé.</p>
                        <a href="chantier.html" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-right"></i> Nos projets
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="bi bi-compass"></i> Archéo-IT</h5>
                    <p>Association dédiée à l'archéologie moderne et aux nouvelles technologies. Nous révolutionnons la compréhension du passé grâce aux outils du futur.</p>
                    <p><strong>Siège social :</strong> 123 Rue de l'Innovation, 75001 Paris</p>
                    <p><strong>Email :</strong> contact@archeoit.fr</p>
                </div>
                <div class="col-md-6">
                    <h5><i class="bi bi-share"></i> Suivez-nous</h5>
                    <div class="d-flex gap-3 mb-3">
                        <a href="https://facebook.com/archeoit" target="_blank" class="text-white">
                            <i class="bi bi-facebook fs-4"></i>
                        </a>
                        <a href="https://twitter.com/archeoit" target="_blank" class="text-white">
                            <i class="bi bi-twitter fs-4"></i>
                        </a>
                        <a href="https://instagram.com/archeoit" target="_blank" class="text-white">
                            <i class="bi bi-instagram fs-4"></i>
                        </a>
                        <a href="https://linkedin.com/company/archeoit" target="_blank" class="text-white">
                            <i class="bi bi-linkedin fs-4"></i>
                        </a>
                    </div>
                    <h6>Partenaires</h6>
                    <p class="small">INRAP • CNRS • Ministère de la Culture • Universités partenaires</p>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p>&copy; 2025 Archéo-IT. Tous droits réservés. | 
                <a href="#" class="text-white">Mentions légales</a> | 
                <a href="#" class="text-white">Politique de confidentialité</a></p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- JavaScript personnalisé -->
    <script>
        // Animation des compteurs statistiques
        function animateCounters() {
            const counters = document.querySelectorAll('.stat-number');
            
            counters.forEach(counter => {
                const target = parseInt(counter.textContent.replace(/,/g, ''));
                const increment = target / 100;
                let current = 0;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        counter.textContent = target.toLocaleString();
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.floor(current).toLocaleString();
                    }
                }, 30);
            });
        }

        // Animation au scroll pour les statistiques
        function checkScrollPosition() {
            const statsSection = document.querySelector('.stats-section');
            const rect = statsSection.getBoundingClientRect();
            
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                animateCounters();
                window.removeEventListener('scroll', checkScrollPosition);
            }
        }

        // Effet parallaxe léger sur la vidéo hero
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const video = document.querySelector('.hero-section video');
            if (video) {
                video.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });

        // Animation des cartes au survol
        document.querySelectorAll('.feature-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Initialisation au chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            // Animation d'apparition des éléments
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            });

            // Observer tous les éléments avec la classe 'fade-in'
            document.querySelectorAll('.timeline-item, .feature-card').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'all 0.6s ease';
                observer.observe(el);
            });

            // Déclenchement de l'animation des compteurs au scroll
            window.addEventListener('scroll', checkScrollPosition);
        });

        // Fonction pour afficher une notification de bienvenue aux utilisateurs connectés
        <?php if (isset($_SESSION['utilisateur'])): ?>
        setTimeout(() => {
            const toast = document.createElement('div');
            toast.className = 'toast align-items-center text-white bg-success border-0 position-fixed';
            toast.style.cssText = 'top: 100px; right: 20px; z-index: 1050;';
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        Bienvenue <?= htmlspecialchars($_SESSION['utilisateur']['nom']) ?> ! 
                        Vous avez accès à toutes nos actualités.
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;
            document.body.appendChild(toast);
            new bootstrap.Toast(toast).show();
        }, 2000);
        <?php endif; ?>
    </script>
</body>
</html>