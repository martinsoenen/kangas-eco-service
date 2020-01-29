# KANGAS - Eco Service

Projet e-commerce réalisé dans le cadre de l'année d'ING1 à l'Institut G4.

## Première installation

Clonez le dépôt git et placez-vous sur la branche develop, ou sur la branche qui vous concerne.

Ensuite, déplacez-vous dans le dossier du dépôt git puis construisez les containers Docker : `docker-compose build`.  
Une fois cela effectué, vous pouvez lancer les containers : `docker-compose up -d`.

Le projet est maintenant disponible si vous aller sur l'URL `localhost` !  
Si vous souhaitez avoir un plus bel URL, vous pouvez ajouter la ligne suivante à votre fichier de hosts `127.0.0.1 dev.eco-service.com` et le projet sera accessible sur l'URL `dev.eco-service.com` !

Pour accéder à PHPMyAdmin, il suffit d'aller sur le port 81 de votre URL (`localhost:81` ou `dev.eco-service.com:81`).

## Docker-compose cheatsheet

  * Démarrer les containers en voyant leurs logs : `docker-compose up`
  * Démarrer les containers en tâche de fond : `docker-compose up -d`
  * Arrêter les containers : `docker-compose stop`
  * Tuer les containers : `docker-compose kill`
  * Détruire les containers : `docker-compose rm`
  * Voir le statut de ses containers : `docker-compose ps`
  * Voir les logs des containers : `docker-compose logs`
  * Faire une commande dans un container : `docker-compose exec SERVICE_NAME COMMAND` où `COMMAND` est la commande que l'on veut. Exemples :  
    - Ouvrir une console dans le container php-fpm : `docker-compose exec php-fpm bash`  
    - Ouvrir la console Symfony : `docker-compose exec php-fpm bin/console`