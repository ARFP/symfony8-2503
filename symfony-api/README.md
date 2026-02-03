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

Une fois le docker-compose.yml et le Dockerfile renseignés, il est temps de créer et lancer le conteneur

```bash
docker compose up --build -d
```

### La configuration du serveur Web 

Pour que Symfony fonctionne bien, nous devons configurer quelques éléments dans la cvonfiguration d'Apache.

Nous alons éditer l'hôte virtuel par défaut dans un fichier qu'il sera nécessaire de copier dans le conteneur à sa création :

- Le répertoire de travail de Apache pointe sur le dossier "public" de symfony. 
    - Le dossier "public" est le point d'entrée des applications Symfony.
- Définir les règles de réécriture d'url pour le routage de Symfony.




```bash
docker exec -it symfony8-2305-web bash
```

## Installation de Symfony