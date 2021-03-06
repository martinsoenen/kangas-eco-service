# KANGAS - Eco Service

Projet e-commerce réalisé dans le cadre de l'année d'ING1 à l'Institut G4 Lyon.

## Première installation

Clonez le dépôt git et placez-vous sur la branche `develop`, ou sur la branche qui vous concerne.

Ensuite, déplacez-vous dans le dossier du dépôt git puis construisez les containers Docker : `docker-compose build`.  
Une fois cela effectué, vous pouvez lancer les containers : `docker-compose up -d`.

Attendez une minute, le temps que toutes les dépendances de composer se téléchargent et que MySQL se lance.

Le projet est maintenant disponible si vous aller sur l'URL `localhost` !  
Si vous souhaitez avoir un plus bel URL, vous pouvez ajouter la ligne suivante à votre fichier de hosts `127.0.0.1 dev.eco-service.com` et le projet sera accessible sur l'URL `dev.eco-service.com` !

Pour accéder à PHPMyAdmin, il suffit d'aller sur le port 81 de votre URL (`localhost:81` ou `dev.eco-service.com:81`).  

Pour accéder à MailHog, il faut aller sur le port 82 de votre URL (`localhost:82` ou `dev.eco-service.com:82`).

## Site de production
Dernière mise en prod : 19/03/2021

Pour accéder au site internet en production, vous pouvez aller sur https://eco-service.martinsoenen.com.

## Docker-compose cheatsheet

  * Démarrer les containers en voyant leurs logs : `docker-compose up`
  * Démarrer les containers en tâche de fond : `docker-compose up -d`
  * Arrêter les containers : `docker-compose stop`
  * Tuer les containers : `docker-compose kill`
  * Détruire les containers : `docker-compose rm`
  * Arrêter et détruire les containers : `docker-compose down`
  * Voir le statut de ses containers : `docker-compose ps`
  * Voir les logs des containers : `docker-compose logs`
  * Faire une commande dans un container : `docker-compose exec CONTAINER_NAME COMMAND` où `COMMAND` est la commande que l'on veut. Exemples :  
      - Ouvrir une console dans le container php-fpm : `docker-compose exec php bash`  
      - Ouvrir la console Symfony : `docker-compose exec php bin/console`

## Symfony 

* Vider le cache : `make cache`
* Créer une nouvelle entité (et création auto du repo) : `make entity`
* Regénérer les getters et setters (+ constructeur et autres) : `make entities`
* Ajouter la base ou mettre à jour le schéma de la base : `make database`
* Lister les routes crées : `make routes` 

## Erreurs connues

* La version de PHP demandée par composer est supérieure à la version existante.  
  Pour corriger l'erreur, tapez `composer config platform.php 7.4.12`.
 
