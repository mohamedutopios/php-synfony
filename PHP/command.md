### Commande composer
 - Créer un projet composer
 ```bash
 composer init
 ```

 - mettre à jour un projet composer en fonction des modifications de composer.json
 ```bash
 composer update
 ```

 - installer un package composer
 ```bash
 composer require <nom_package>
 ```

### Commande symfony 

- Création d'un projet complet avec la version 6.4
 ```bash
symfony new demo-symfony --version="6.4" --full
 ```

- Démarrer un serveur web avec symfony
 ```bash
symfony serve
 ```

- Liste des routes dans symfony

 ```bash
php bin/console debug:router
 ```

- Création des contrôleurs à l'aide du CLI

```
php bin/console make:controller <NomController>
```

- Les méthodes du get
https://symfony.com/doc/current/components/http_foundation.html#request

- Liste des services injectés.

 ```bash
php bin/console debug:autowiring
 ```

- Commande pour créer une entité

 ```bash
php bin/console make:entity
 ```
- Commande pour créer une migration

 ```bash
php bin/console make:migration
 ```
- Commande pour appliquer une migration

```bash
php bin/console doctrine:migrations:migrate
```

### Commande docker

- Commande build image
```bash
docker build -t <image> .
```

- Commande pour démarrer un conteneur
```bash
docker run -d -p 80:80 <nom_image>
```
