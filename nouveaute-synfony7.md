Symfony 7, sorti le 29 novembre 2023, introduit plusieurs nouveautés et améliorations significatives pour les développeurs. Voici un aperçu des principales fonctionnalités :

**1. Command Profiler**
Symfony 7 étend les capacités du Profiler en permettant le profilage des commandes console. En ajoutant l'option `--profile` lors de l'exécution d'une commande, les développeurs peuvent collecter des informations détaillées sur l'exécution des commandes, facilitant ainsi le débogage et l'optimisation. 

**2. Request Data Mapper**
Cette fonctionnalité permet de mapper automatiquement les données des requêtes entrantes vers des objets DTO (Data Transfer Objects) typés et validés. Cela simplifie la gestion des données dans les contrôleurs et améliore la robustesse du code. 

**3. AssetMapper**
AssetMapper facilite la gestion des assets frontend en utilisant des standards web modernes tels que les modules ECMAScript (ESM) et les importmaps. Il permet d'incorporer des packages JavaScript sans nécessiter de configuration complexe ou d'outils de build, simplifiant ainsi le développement frontend. 

**4. Profiler Redesign**
Le Profiler de Symfony a été repensé avec une interface utilisateur modernisée, offrant une meilleure expérience de débogage grâce à une présentation plus claire et intuitive des informations. 

**5. Locale Switcher**
Cette fonctionnalité permet de changer la locale de l'application de manière dynamique, facilitant la gestion des applications multilingues et l'adaptation du contenu en fonction des préférences de l'utilisateur. 

**6. Dynamic Constraints**
Avec l'introduction de la contrainte `When`, il est désormais possible d'appliquer des contraintes de validation de manière conditionnelle, en fonction d'expressions spécifiques, offrant une flexibilité accrue dans la validation des données. 

**7. Early Hints**
Symfony 7 supporte les "Early Hints", une fonctionnalité qui améliore les performances perçues des applications web en indiquant aux navigateurs quels ressources charger en priorité, avant même que la réponse complète ne soit reçue. 

**8. Nouveaux Composants**
- **Scheduler** : Permet de déclencher et d'envoyer des messages selon un calendrier prédéfini, facilitant la gestion des tâches planifiées.
- **DatePoint** : Offre une implémentation moderne de `DateTime`, corrigeant les limitations des types natifs de PHP et s'intégrant pleinement avec le composant Clock. 

**9. Suppression des Dépréciations**
Symfony 7 a supprimé toutes les fonctionnalités dépréciées de la version 6.4, résultant en une base de code plus légère et plus maintenable, avec 41 répertoires et 264 fichiers en moins, et une réduction de 47 386 lignes de code. 

**10. Typage Amélioré**
L'ajout de types natifs PHP à toutes les propriétés et valeurs de retour des méthodes améliore la gestion des erreurs, le débogage et l'auto-complétion dans les environnements de développement intégrés (IDE). 

Ces améliorations font de Symfony 7 une version majeure, offrant aux développeurs des outils plus puissants et une expérience de développement enrichie. 