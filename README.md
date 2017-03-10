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

Pour tester les pages comprenant des fonctions PHP rajoutez "?debug" après l'URL.
Exemple: /submit.php?debug

Les pages ayant du php mais n'utilisant pas de fonctions distinctes n'ont pas de tests implémentés.