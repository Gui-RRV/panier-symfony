# panier-symfony

Mini projet de panier sur Symfony qui m'a été proposé dans le cadre d'une recherche d'alternance et qui par la même occasion permet de mettre à jour
mon ancien mini projet de panier en php procédural ;)

Le projet contient:

- une Page d’accueil qui affiche la totalité des produits ordonnés par nom et un bouton sur chaque produits pour consulter les produits.
- une Page de détails d’un produit qui affiche les informations du produit ainsi que la possibilité de l'ajouter au panier.
- une Page du panier avec le contenu, le prix total ainsi que la possibilité de le vider (acheter) et de modifier les quantité des produits (supprimer ou ajouter).
- une interface d'administration securisé avec EasyAdmin 
  
  Accèdez-y via le lien Administration dans le header, les informations de login sont:
  Usernanme : admin
  Password : password


Instructions:

Pour installer le projet vous devez faire:
- composer install
- composer update
- npm install
- npm update
- yarn install
- yarn upgrade

Tout cela permettra d'installer les dépendances requises au bon fonctionnement du projet !

Maintenant que le projet est installé il faut mettre en place la base de données, utilisant sqlite pour ce projet un fichier .db est déjà présent.
Pour Remplir ce fichier voici la marche à suivre :

- php bin/console doctrine:migrations:diff
- php bin/console doctrine:migrations:migrate
- php bin/console doctrine:fixtures:load

A chaque question vous pouvez répondre yes.

Maintenant il ne reste plus qu'à lancer le projet ! Pour ce faire faites ceci:
- symfony server:start (lancera le serveur interne de symfony)
- yarn encore dev --watch (compilera les assets du projets, peut mettre un certains temps mais est indispensable)

Deux tests sont disponibles, vous pouvez les lancer en faisant:
- php bin/phpunit (cela mettra peut être un peu de temps le temps que le bundle phpunit s'installe)

