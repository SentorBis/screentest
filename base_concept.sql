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
		screen_id		INTEGER		NOT NULL,
		image			BYTEA		NOT NULL,
		answer0 		VARCHAR(50)	NOT NULL,
		answer1 		VARCHAR(50)	NOT NULL,
		answer2 		VARCHAR(50)	NOT NULL,
		answer3 		VARCHAR(50)	NOT NULL,
		cat_id			INTEGER		NOT NULL,
		validated		BOOLEAN		NOT NULL COMMENT, /*Une question ajoutée par un internaute n'est pas validée. Il faut validation de l'administrateur pour que la question soit utilisable. */
		PRIMARY KEY (screen_id),
		FOREIGN KEY(cat_id) REFERENCES screentest.Category(cat_id) ON DELETE RESTRICT ON UPDATE CASCADE);