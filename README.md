#ScreenTest

par Grégoire Labasse (#6607969)

## Synopsis

Un site dédié à la génération et à l'exécution de quiz demandant à l'utilisateur de deviner de quel film / série / jeu vidéo / etc. provient chaque image qui lui est montrée.
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

3. Changer les informations de connection à la base de données dans les fichiers *quiz.php*, *getQuestion.php*, *submit.php* et *admin.php* pour correspondre aux votres (notamment 'port=x' où x doit correspondre au port où se situe la BDD PGSQL et 'password=y' où y doit correspondre à votre mot de passe SU pour PGSQL)

## Mode d'emploi

Pour simplement jouer au quiz, suivez les menus ou allez directement sur *quiz.php*. Les questions et les images sont crowd-sourcées donc au départ aucune catégorie n'a de questions.
Pour ajouter une question allez à la page de soumission de question (*submit.php*). Aucune question n'est acceptée directement pour être utilisée dans les quiz, donc une fois quelques questions soumises, allez à *admin.php* pour valider vos questions.

Si vous voulez pouvoir tester le jeu aussi vite que possible avec des questions déjà incluses, décompressez le fichier *screentesttest.zip* dans un dossier séparé et suivez les instructions présentes dans le *README.txt*.

## Tests

Pour tester les pages comprenant des fonctions PHP rajoutez "?debug" après l'URL.
Exemple: /submit.php?debug

Les pages ayant du php mais n'utilisant pas de fonctions distinctes n'ont pas de tests implémentés.