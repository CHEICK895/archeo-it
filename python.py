# On importe les bibliothèques nécessaires
import random   # pour choisir des caractères aléatoires
import string   # pour avoir accès aux lettres, chiffres, caractères spéciaux

# Fonction pour poser les questions à l'utilisateur
def poser_questions():
    print("=== Générateur de mot de passe sécurisé ===")
    print("Choisissez le type de mot de passe :")
    print("1 - Lettres uniquement (A-Z, a-z)")
    print("2 - Lettres et chiffres (A-Z, a-z, 0-9)")
    print("3 - Lettres, chiffres et caractères spéciaux (!, @, #, etc.)")

    choix = input("Entrez votre choix (1, 2 ou 3) : ")
    
    # Tant que l'utilisateur ne tape pas 1, 2 ou 3, on repose la question
    while choix not in ['1', '2', '3']:
        print("Erreur : veuillez entrer 1, 2 ou 3.")
        choix = input("Entrez votre choix (1, 2 ou 3) : ")

    # On demande la longueur du mot de passe
    longueur = input("Combien de caractères pour le mot de passe ? (minimum 6) : ")
    
    # On vérifie que c’est bien un chiffre et qu’il est supérieur ou égal à 6
    while not longueur.isdigit() or int(longueur) < 6:
        print("Erreur : entrez un nombre entier supérieur ou égal à 6.")
        longueur = input("Combien de caractères ? : ")

    return choix, int(longueur)

# Fonction qui génère le mot de passe
def generer_mot_de_passe(choix, longueur):
    # Selon le choix de l'utilisateur, on définit les caractères à utiliser
    if choix == '1':
        caracteres = string.ascii_letters  # lettres seulement (majuscules et minuscules)
    elif choix == '2':
        caracteres = string.ascii_letters + string.digits  # lettres + chiffres
    else:
        caracteres = string.ascii_letters + string.digits + string.punctuation  # tout !

    # On crée le mot de passe en prenant des caractères au hasard
    mot_de_passe = ''.join(random.choice(caracteres) for _ in range(longueur))
    return mot_de_passe

# Partie principale du programme
if __name__ == "__main__":
    # On appelle la fonction pour poser les questions
    type_choisi, longueur = poser_questions()
    
    # On génère le mot de passe
    mot_de_passe = generer_mot_de_passe(type_choisi, longueur)
    
    # On affiche le résultat
    print("\nVoici votre mot de passe sécurisé :")
    print(mot_de_passe)
# On importe les bibliothèques nécessaires
import random   # pour choisir des caractères aléatoires
import string   # pour avoir accès aux lettres, chiffres, caractères spéciaux

# Fonction pour poser les questions à l'utilisateur
def poser_questions():
    print("=== Générateur de mot de passe sécurisé ===")
    print("Choisissez le type de mot de passe :")
    print("1 - Lettres uniquement (A-Z, a-z)")
    print("2 - Lettres et chiffres (A-Z, a-z, 0-9)")
    print("3 - Lettres, chiffres et caractères spéciaux (!, @, #, etc.)")

    choix = input("Entrez votre choix (1, 2 ou 3) : ")
    
    # Tant que l'utilisateur ne tape pas 1, 2 ou 3, on repose la question
    while choix not in ['1', '2', '3']:
        print("Erreur : veuillez entrer 1, 2 ou 3.")
        choix = input("Entrez votre choix (1, 2 ou 3) : ")

    # On demande la longueur du mot de passe
    longueur = input("Combien de caractères pour le mot de passe ? (minimum 6) : ")
    
    # On vérifie que c’est bien un chiffre et qu’il est supérieur ou égal à 6
    while not longueur.isdigit() or int(longueur) < 6:
        print("Erreur : entrez un nombre entier supérieur ou égal à 6.")
        longueur = input("Combien de caractères ? : ")

    return choix, int(longueur)

# Fonction qui génère le mot de passe
def generer_mot_de_passe(choix, longueur):
    # Selon le choix de l'utilisateur, on définit les caractères à utiliser
    if choix == '1':
        caracteres = string.ascii_letters  # lettres seulement (majuscules et minuscules)
    elif choix == '2':
        caracteres = string.ascii_letters + string.digits  # lettres + chiffres
    else:
        caracteres = string.ascii_letters + string.digits + string.punctuation  # tout !

    # On crée le mot de passe en prenant des caractères au hasard
    mot_de_passe = ''.join(random.choice(caracteres) for _ in range(longueur))
    return mot_de_passe

# Partie principale du programme
if __name__ == "__main__":
    # On appelle la fonction pour poser les questions
    type_choisi, longueur = poser_questions()
    
    # On génère le mot de passe
    mot_de_passe = generer_mot_de_passe(type_choisi, longueur)
    
    # On affiche le résultat
    print("\nVoici votre mot de passe sécurisé :")
    print(mot_de_passe)
