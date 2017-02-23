#ScreenTest

par Grégoire Labasse (#6607969)

## Synopsis

Un site dédié à la génération et à l'exécution de quiz demandant à l'utilisateur de deviner de quel film / série / bande dessinée / etc. provient chaque image qui lui est montrée.
Voici une liste non-exhaustive de fonctionnalités que l'on cherche à introduire dans ce projet :
 - une base de données contenant des images avec des questions pour proposer des quiz à thème triés par catégorie d'image
 - une page pour uploader de nouvelles images  avec les réponses associées
 - un outi de modération pour éviter les abus et vérifier la qualité des uploads

## Motivation

Mes principaux intérêts résident dans la culture populaire, notamment japonaise, avec tout ce que ça implique de jeux vidéo, de films, d'anime, de manga et de médias variés. Et tout comme il est agréable d'apprendre à connaître ces médias j'apprécie les jeux qui me permettent de tester ma culture. Ce projet permettra donc enfin d'avoir un outil pour se faire des quiz là-dessus.

## Installation

Pour utiliser l'application web :
Prérequis : un serveur web installé localement (notamment Apache) et PostgreSQL installé sur ce serveur
1. Exécuter les query SQL du fichier *base_concept.sql* sur PostgreSQL
2. Mettre les fichiers à la racine du serveur
3. Changer les informations de connection à la base de données dans le fichier *query.php* pour correspondre aux votres (notamment 'port=x' où x doit correspondre au port où se situe la BDD PGSQL et 'password=y' où y doit correspondre à votre mot de passe SU pour PGSQL)

## Tests

La page *query.php* permet de vérifier que l'application peut se connecter à la base de données et en extraire des données. Si tout fonctionne, elle devrait afficher quatre lignes correspondant aux données insérées dans la table Category de la BDD.

La page *chrono.html* permet de vérifier le fonctionnement d'un script Javascript faisant un décompte de quinze secondes. Un bouton permettant de réinitialiser le compteur (le faire repartir de 15) est présent, représentant une première composante interactive de l'application web.

Ces deux pages sont présentes à fin de test et seront retirées une fois que les fonctions associées seront intégrées à l'ensemble de l'application.