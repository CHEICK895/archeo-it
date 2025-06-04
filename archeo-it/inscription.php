<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription utilisateur</title>
    <link rel="stylesheet" href="inscription.css">
</head>
<body>
  <div class="formulaire-container">
        <div class="header">
            <div class="logo">🏛️</div>
            <h2>🏺 Créer un nouvel utilisateur</h2>
            <p class="subtitle">Archéo-IT - Inscription</p>
        </div>
        
        <div class="info-mot-de-passe">
            🔐 Un mot de passe sécurisé sera généré automatiquement
        </div>

        <form method="post" action="traitement_inscription.php">
            
            <!-- Champ Email -->
            <div class="champ-groupe">
                <label for="email">📧 Email :</label>
                <input type="email" 
                       id="email"
                       name="email" 
                       required 
                       placeholder="Votre adresse email">
            </div>

            <!-- Champ Nom -->
            <div class="champ-groupe">
                <label for="nom">👤 Nom :</label>
                <input type="text" 
                       id="nom"
                       name="nom" 
                       required 
                       placeholder="Votre nom complet">
            </div>

            <!-- Ligne avec Type et Longueur côte à côte -->
            <div class="ligne-champs">
                <!-- Type de mot de passe -->
                <div class="champ-groupe">
                    <label for="mode">🔒 Type de mot de passe :</label>
                    <select name="mode" id="mode">
                        <option value="1">Lettres seulement</option>
                        <option value="2" selected>Lettres + Chiffres</option>
                        <option value="3">Lettres + Chiffres + Symboles</option>
                    </select>
                </div>

                <!-- Longueur du mot de passe -->
                <div class="champ-groupe">
                    <label for="longueur">📏 Longueur :</label>
                    <input type="number" 
                           id="longueur"
                           name="longueur" 
                           value="12" 
                           min="6" 
                           max="50">
                </div>
            </div>

            <!-- Bouton de soumission -->
            <button type="submit" class="bouton-creer">
                Créer l'utilisateur
            </button>
        </form>

        <div class="login-link">
            <p>Déjà un compte ?</p>
            <a href="archeo_login_page.html">Se connecter</a>
        </div>
    </div>
</body>
</html>

