# Symfony8-2503

Création d'une API REST

Procédure d'installation de Symfony avec Docker.

## Stack technique

Identifier les composants nécessaires pour exécuter le projet.

- Une base de données
    - Mariadb 11.8.5
- Un serveur web avec l'interpréteur PHP
    - Apache 2.4
    - PHP 8.4
    - Composer gestionnaire de dépendances pour PHP
- Symfony 8.x avec API PLatform
    - à installer dans le conteneur à l'aide de Composer

A partir de cette liste, nous pouvons créer un conteneur Docker qui exécutera notre future application Symfony.

Les services Base de données et Serveur Web seront séparés dans des conteneurs distincts. 

### Le Docker-compose 

[Voir le docker-compose.yml](./docker-compose.yml)

Pour le service Web, un Dockerfile est nécessaire afin de pouvoir installer les outils et modules nécessaires au bon fonctionnement de notre application.

[Voir le Dockerfile](./Dockerfile)

[Voir le fichier de configuration de l'hôte virtuel d'Apache](./conf/000-default.conf)

Une fois le docker-compose.yml et le Dockerfile renseignés, il est temps de créer et lancer le conteneur

```bash
docker compose up --build -d
```

```bash
docker exec -it symfony8-2305-web bash
```

## Installation de Symfony

1. Accéder au terminal du container web (symfony8-2305-web)
2. Se positionner sur le chemin '/var/www/html'
    - Bien vérifier qu'il est vide (le vider si nécessaire)
3. Lancer l'installation de Symfony
    - `composer create-project symfony/skeleton:"8.0.*" .`
    - (Pensez à bien mettre le . à la fin de la commande (. = répertoire courant))
4. Patienter...

L'installation de Symfony est terminée

- Accéder à l'url http://127.0.0.1:8000
- Vous devriez voir la page par défaut de Symfony.

## Installation des dépendances Symfony pour créer une API Rest

```sh
composer require symfony/maker-bundle --dev
composer require api 
``` 

Cette commande va installer les dépendances nécessaires pour un projet d'API Rest.

Une fois les dépendances installées, accéder à l'url [http://localhost:8000/index.php/api/](http://localhost:8000/index.php/api/). Vous devriez voir une page ayant pour titre "Hello API Platform.

Le projet étant destiné à n'accueillir qu'une API, nous allons le configurer pour que l'adresse de base [http://localhost:8000/](http://localhost:8000/) pointe directement sur l'API.

Ouvrir le fichier `myapi/config/routes/api_platform.yaml`

Puis commenter la ligne `prefix: /api` en la prefixant avec un hashtag comme ceci : `# prefix: /api`.

# Configurer et créer la base de données

Ouvrir le fichier `myapi/.env`

Commenter la ligne `DATABASE_URL="postgre.....

et ajouter en dessous la ligne suivante : 

`DATABASE_URL="mysql://user:user@db:3306/db_myapi?serverVersion=11.8.5-MariaDB&charset=utf8mb4"`

Direction le terminal du conteneur Web :

```bash
cd /var/www/html
php bin/console doctrine:database:create
```

## Créer la 1ère entité.


```bash
cd /var/www/html
composer require symfony/maker-bundle --dev
php bin/console make:entity
```

## Sauvegarder les changements

```bash
cd /var/www/html
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

# Autres commandes de migrations : 


```bash
# Afficher la version de la migration en cours
php bin/console doctrine:migrations:current   
# Afficher la version de la dernière migration  
php bin/console doctrine:migrations:latest   
# Afficher la liste de toutes les migrations et leurs statuts  
php bin/console doctrine:migrations:list     
# Afficher des informations sur l'état actuel des migrations et autres   
php bin/console doctrine:migrations:status      
```

