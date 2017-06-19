Projet pour NFE114
==========

A Symfony project created on March 23, 2017, 10:35 pm.

Pour executer le projet il faut installer Symfony sur la machine cible et avoir une base de donnée MYSQL nommé Corent en local avec WAMP ou MAMP(MAC). 

Voici un tutoriel pour installer Symfony et mettre en place la base de données: 
https://symfony.com/doc/current/setup.html
https://symfony.com/doc/current/doctrine.html

Le coueur du projet se trouve dans Corent/src/AppBundle.

Les views du projet se trouvent dans : Corent/app/Ressources/views.

Pour voir la partie backoffice il faut : 
1. Créer un super-utilisateur dans le terminal avec la commande : php app/console fos:user:create adminuser --super-admin ; et suivre les instructions
2. Se connecter dans http://localhost:8000/login
3. Acceder au backoffice : http://localhost:8000/admin


