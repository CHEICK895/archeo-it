<?php
session_start();

if (!isset($_SESSION['utilisateur']) || !isset($_SESSION['mot_de_passe_temporaire'])) {
    echo "Aucune information d'inscription disponible.";
    exit;
}

$email = $_SESSION['utilisateur']['email'];
$nom = $_SESSION['utilisateur']['nom'];
$mot_de_passe = $_SESSION['mot_de_passe_temporaire'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription Réussie</title>
    <style>
        /* Supprime les marges par défaut du navigateur */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            
            /* Image d'arrière-plan archéologique - Site de fouilles */
            background-image: url('https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
            background-size: cover; /* L'image couvre tout l'écran */
            background-position: center; /* Centre l'image */
            background-repeat: no-repeat; /* Pas de répétition */
            
            /* Couleur de superposition pour assombrir l'image */
            background-color: rgba(139, 69, 19, 0.7);
            background-blend-mode: overlay;
            
            /* Hauteur minimum = toute la hauteur de l'écran */
            min-height: 100vh;
            
            /* Centre le contenu au milieu de l'écran */
            display: flex;
            justify-content: center; /* Centre horizontalement */
            align-items: center; /* Centre verticalement */
            padding: 20px;
        }

        /* Style du conteneur principal */
        .succes-container {
            background-color: rgba(245, 222, 179, 0.95); /* Beige transparent */
            padding: 40px; /* Espacement intérieur */
            border-radius: 15px; /* Coins arrondis */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3); /* Ombre portée */
            width: 100%;
            max-width: 500px; /* Largeur maximale */
            border: 2px solid #D2691E; /* Bordure orange */
            text-align: center; /* Centre le texte */
        }

        /* Style du titre principal */
        h2 {
            color: #8B4513; /* Brun foncé */
            margin-bottom: 20px;
            font-size: 28px;
        }

        /* Style des paragraphes */
        p {
            color: #654321; /* Brun */
            font-size: 16px;
            line-height: 1.5; /* Espacement entre les lignes */
            margin-bottom: 15px;
        }

        /* Style pour les informations importantes */
        .info-importante {
            background-color: rgba(210, 105, 30, 0.2); /* Orange clair */
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #D2691E; /* Bordure gauche orange */
            margin: 20px 0;
            text-align: left;
        }

        /* Style pour les données utilisateur */
        .donnees-utilisateur {
            background-color: rgba(255, 255, 255, 0.7); /* Blanc transparent */
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border: 1px solid #CD853F;
        }

        /* Style du texte en gras */
        strong {
            color: #8B4513;
        }

        /* Style du mot de passe (police monospace pour lisibilité) */
        .mot-de-passe {
            font-family: 'Courier New', monospace;
            background-color: #f0f0f0;
            padding: 5px 8px;
            border-radius: 3px;
            font-size: 14px;
            color: #333;
        }

        /* Style du lien de connexion */
        .lien-connexion {
            display: inline-block; /* Permet de styliser comme un bouton */
            background-color: #8B4513; /* Brun foncé */
            color: white;
            padding: 15px 30px;
            text-decoration: none; /* Supprime le soulignement */
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
            border: 2px solid #8B4513;
        }

        /* Style du lien au survol */
        .lien-connexion:hover {
            background-color: #654321; /* Brun plus foncé */
            border-color: #654321;
        }

        /* Message d'alerte pour sauvegarder le mot de passe */
        .alerte-sauvegarde {
            background-color: #D2691E; /* Orange */
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            font-weight: bold;
        }

        /* Icône de succès */
        .icone-succes {
            font-size: 48px;
            margin-bottom: 20px;
        }

        /* Style responsive pour petits écrans */
        @media (max-width: 600px) {
            .succes-container {
                padding: 20px;
                margin: 10px;
            }
            
            h2 {
                font-size: 24px;
            }
            
            .icone-succes {
                font-size: 36px;
            }
        }
    </style>
</head>
<body>
    <div class="succes-container">
        <!-- Icône de succès -->
        <div class="icone-succes">🎉</div>
        
        <h2>Bienvenue, <?= htmlspecialchars($nom) ?> !</h2>
        
        <p>Votre compte a été créé avec succès.</p>
        
        <!-- Informations utilisateur dans une boîte -->
        <div class="donnees-utilisateur">
            <p><strong>📧 Email :</strong> <?= htmlspecialchars($email) ?></p>
            <p><strong>🔑 Mot de passe :</strong> 
                <span class="mot-de-passe"><?= htmlspecialchars($mot_de_passe) ?></span>
            </p>
        </div>
        
        <!-- Message important -->
        <div class="alerte-sauvegarde">
            ⚠️ Conservez bien ce mot de passe, il vous permettra de vous reconnecter plus tard.
        </div>
        
        <!-- Lien de connexion stylisé comme un bouton -->
        <a href="connexion.php" class="lien-connexion">
            🔓 Se connecter
        </a>
    </div>
</body>
</html>