
CREATE DATABASE IF NOT EXISTS dbdomande
    CHARACTER SET = 'utf8'
    COLLATE = 'utf8_unicode_ci';

USE dbdomande;

DROP TABLE IF EXISTS dr_domande;
CREATE TABLE dr_domande
(
    codice    INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    domanda   NVARCHAR(100)  NOT NULL,
    risposta  NVARCHAR(100),
    nickname  NVARCHAR(25),
    img       LONGBLOB,
    tipo      NVARCHAR(30)
);

INSERT INTO dr_domande(domanda) VALUES ('Qual è il monte più alto d''Europa?');
INSERT INTO dr_domande(domanda) VALUES ('Qual è la formula chimica dell''acido cloridrico?');
