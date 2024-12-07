https://symfony.com/doc/current/setup.html


Voici une liste complète des commandes Symfony CLI et leur utilité. Elles sont classées par catégorie pour une utilisation claire :

---

### **Commandes Générales**
1. **Aide et version :**
   - `symfony help` : Affiche l’aide générale pour la CLI Symfony.
   - `symfony version` : Affiche la version de la CLI Symfony.

2. **Configuration :**
   - `symfony self:update` : Met à jour la CLI Symfony.
   - `symfony about` : Donne des informations sur l’installation de la CLI.

---

### **Création et Gestion de Projets**
1. **Créer un nouveau projet :**
   - `symfony new my_project --webapp` : Crée un nouveau projet Symfony complet (avec webapp).
   - `symfony new my_project --version=6.3` : Crée un projet avec une version spécifique de Symfony.

2. **Démarrer un projet existant :**
   - `symfony check:requirements` : Vérifie les prérequis du projet.

---

### **Exécution et Serveur**
1. **Lancer un serveur local :**
   - `symfony serve` : Démarre le serveur Symfony.
   - `symfony serve --no-tls` : Démarre le serveur sans HTTPS.
   - `symfony serve:stop` : Arrête le serveur.
   - `symfony serve:start` : Lance le serveur en arrière-plan.

2. **Inspecter les logs :**
   - `symfony server:log` : Affiche les journaux du serveur.

---

### **Gestion des Dépendances**
1. **Composer via Symfony CLI :**
   - `symfony composer install` : Installe les dépendances Composer.
   - `symfony composer update` : Met à jour les dépendances Composer.
   - `symfony composer require twig` : Ajoute un package (par exemple, Twig).

---

### **Débogage**
1. **Déboguer les routes :**
   - `symfony console debug:router` : Liste toutes les routes disponibles.
   - `symfony console debug:event-dispatcher` : Liste les événements et leurs listeners.

2. **Déboguer les services :**
   - `symfony console debug:container` : Liste tous les services enregistrés.
   - `symfony console debug:config` : Affiche la configuration des bundles.

---

### **Commandes liées à la Console Symfony**
1. **Exécuter la console Symfony :**
   - `symfony console list` : Liste toutes les commandes disponibles.
   - `symfony console make:controller MyController` : Crée un contrôleur.
   - `symfony console make:entity` : Crée une entité.
   - `symfony console doctrine:migrations:migrate` : Exécute les migrations.

---

### **Déploiement**
1. **Préparer le déploiement :**
   - `symfony deploy` : Déploie l’application Symfony.
   - `symfony env:vars` : Gère les variables d’environnement.

---

### **Base de Données**
1. **Gestion des migrations :**
   - `symfony console doctrine:migrations:diff` : Génère une migration à partir des modifications de la base de données.
   - `symfony console doctrine:migrations:status` : Vérifie le statut des migrations.

2. **Gestion des schémas :**
   - `symfony console doctrine:schema:update --force` : Applique les modifications du schéma à la base de données.

---

### **Tests**
1. **Lancer les tests :**
   - `symfony php bin/phpunit` : Exécute les tests.

---

### **Autres Utilitaires**
1. **Profiler :**
   - `symfony profiler:dump` : Affiche les données du profiler.

2. **Cache :**
   - `symfony console cache:clear` : Vide le cache.
   - `symfony console cache:warmup` : Génère le cache.

---

Ces commandes couvrent la majorité des cas d'utilisation pour le développement avec Symfony. N'hésitez pas à demander des détails ou des démonstrations spécifiques !


