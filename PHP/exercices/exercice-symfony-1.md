### Exercice: Devine la capitale avec Symfony

#### Objectif
Créer une application web qui affiche une question du type "Quelle est la capitale de ce pays ?". L'utilisateur doit répondre à la question, et l'application lui indique si sa réponse est correcte ou non, puis passe à la question suivante.

#### Fonctionnalités

1. **Affichage d'une question**: Une route `/question` qui affiche de manière aléatoire le nom d'un pays et un champ de texte pour saisir la capitale.

2. **Validation de la réponse**: Après soumission de la requête, une route `/reponse` qui valide si la réponse donnée est correcte ou non et affiche un message approprié. Elle propose également un lien pour passer à une autre question.

