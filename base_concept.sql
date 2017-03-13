SET search_path = screentest;

DROP SCHEMA IF EXISTS screentest CASCADE;
CREATE SCHEMA screentest;


DROP TABLE IF EXISTS screentest.Category;
CREATE TABLE IF NOT EXISTS  screentest.Category (
		cat_id			INTEGER		NOT NULL,
		cat_name 		VARCHAR(20)	NOT NULL,
		description VARCHAR(200)	NOT NULL,
		PRIMARY KEY (cat_id));
		

DROP TABLE IF EXISTS screentest.Question;
CREATE TABLE IF NOT EXISTS  screentest.Question (
		screen_id		SERIAL PRIMARY KEY,
		image			VARCHAR(25)	NOT NULL, /*Fait référence directement à l'url de l'image.*/
		answer0 		VARCHAR(50)	NOT NULL,
		answer1 		VARCHAR(50)	NOT NULL,
		answer2 		VARCHAR(50)	NOT NULL,
		answer3 		VARCHAR(50)	NOT NULL,
		cat_id			INTEGER		NOT NULL,
		validated		BOOLEAN		NOT NULL DEFAULT false, /*Une question ajoutée par un internaute n'est pas validée. Il faut validation de l'administrateur pour que la question soit utilisable. */
		FOREIGN KEY(cat_id) REFERENCES screentest.Category(cat_id) ON DELETE RESTRICT ON UPDATE CASCADE);

INSERT INTO screentest.Category(cat_id, cat_name, description) VALUES (1,'Cinéma','La catégorie de tous les films, sans restriction de taille ou de forme.');
INSERT INTO screentest.Category(cat_id, cat_name, description) VALUES (2,'Séries','La catégorie des séries télévisées (ou non) avec des vrais acteurs dedans.');
INSERT INTO screentest.Category(cat_id, cat_name, description) VALUES (3,'Jeu vidéo','La catégorie des jeux vidéo de Pong à Grand Theft Auto V.');
INSERT INTO screentest.Category(cat_id, cat_name, description) VALUES (4,'Dessins animés','La catégorie des séries animées, dessinées à la main ou animées en 3D.');

