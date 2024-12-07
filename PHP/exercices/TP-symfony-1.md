### Sujet du TP: **Bataille Navale en Ligne**

#### Objectif:
Développer une version simplifiée du jeu classique de bataille navale, où les joueurs peuvent affronter l'ordinateur en utilisant Symfony. Le jeu ne nécessite pas de persistance des données.

#### Fonctionnalités:

1. **Configuration du Jeu**
   - Permettre aux joueurs de placer leurs navires sur une grille de manière (par exemple 3 navires avec des coordonnées sur une grille de 12X12). Les navires peuvent avoir différentes tailles et orientations.
   - Implémenter une interface simple pour cette configuration, potentiellement en utilisant des formulaires Symfony pour capturer les choix de l'utilisateur.

2. **Déroulement d'une Partie**
   - Les joueurs prennent tour à tour des tirs en sélectionnant des coordonnées sur la grille de l'adversaire.
   - Le jeu vérifie si un tir est un coup manqué, un coup touché, ou si un navire est coulé.
   - Utiliser des sessions Symfony pour suivre l'état du jeu entre les requêtes, sans stocker les informations dans une base de données.

3. **Logique de l'Adversaire IA**
   - Pour les parties jouées contre l'ordinateur, développer une logique simple d'IA pour sélectionner des cibles.
   - L'IA peut être simple, choisissant des coordonnées aléatoirement.

4. **Fin de Partie et Réinitialisation**
   - Déterminer la fin de la partie quand tous les navires d'un joueur sont coulés.
   - Offrir une option pour recommencer une nouvelle partie une fois la partie actuelle terminée.


- **Formulaires et Validation**: Utiliser les formulaire pour gérer la saisie des positions des navires.
- **Sessions**: Exploiter les sessions pour maintenir l'état du jeu entre les différentes requêtes HTTP, sans avoir besoin d'une base de données.
- **Routing et Contrôleurs**: Gérer la navigation entre les différentes étapes du jeu (placement des navires, jeu, fin de partie) en utilisant le système de routing de Symfony.
- **Twig**: Créer des templates pour l'interface utilisateur, en utilisant le moteur de template Twig pour afficher la grille de jeu, les messages de statut, et les options de réinitialisation.

5. **Ajout d'une couche de persistence**
- Ajouter la possibilité d'enregistrer dans une base des données, les joueurs ainsi que leurs scores (Victoire,...).

6. **Ajouter un EventSubscriber pour annoncer le début d'une partie**.

7. **Créer une commande pour connaitre le nombre total des parties jouées**.

8. **Exécuter l'application dans un conteneur docker**
