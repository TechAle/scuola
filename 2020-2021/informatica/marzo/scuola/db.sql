create DATABASE if not exists scuola;
use scuola;

drop table if exists UTENTI;
drop table if exists LAVORO;
create table LAVORO (
    grado tinyint unsigned primary key auto_increment,
    nome varchar(30) not null unique
);

create table UTENTI (
    idutente int unsigned primary key auto_increment,
    nome varchar(30) not null,
    cognome varchar(30) not null,
    datanascita date not null,
    email varchar(30) not null unique,
    password varchar(30),
    grado tinyint unsigned not null,
    abilitato boolean not null,
    FOREIGN KEY (grado) REFERENCES lavoro(grado)
);

drop function if EXISTS getLavoroIdx;
DELIMITER //

CREATE FUNCTION getLavoroIdx ( nomeIn varchar(30) )
    RETURNS tinyint unsigned

BEGIN

    RETURN (select grado from scuola.LAVORO where nome like nomeIn);

END; //

DELIMITER ;

drop procedure if exists aggiungi_lavoro;
DELIMITER
//
CREATE PROCEDURE aggiungi_lavoro (
    nome varchar(30)
)
BEGIN
    INSERT INTO LAVORO(nome)
    VALUES (nome);
END
//
DELIMITER ;

drop procedure if exists aggiungi_utenti;
DELIMITER
//
CREATE PROCEDURE aggiungi_utenti (
    nome varchar(30),
    cognome varchar(30),
    datanascita date,
    email varchar(30),
    gradoText varchar(30),
    abilitato boolean
)
BEGIN

    SET @s = (select getLavoroIdx(gradoText));

    INSERT INTO UTENTI(nome, cognome, datanascita, email, grado, abilitato)
    VALUES (nome, cognome, datanascita, email, @s, abilitato);
END
//
DELIMITER ;

CALL aggiungi_lavoro('Amministratore');
CALL aggiungi_lavoro('Presidenza');
CALL aggiungi_lavoro('Docente');
CALL aggiungi_lavoro('Studente');

call aggiungi_utenti('Paolo', 'Ferro', '1957-06-10', 'paolo.ferro@email.com', 'Amministratore', true);
call aggiungi_utenti('Mario', 'Giacomo', '1954-03-10', 'mario.giacomo@email.com', 'Amministratore', true);
call aggiungi_utenti('Giacomo', 'Viotti', '1999-11-2', 'giacomo.viotti@email.com', 'Presidenza', true);
call aggiungi_utenti('Lollo', 'Caio', '2001-2-3', 'lollo.caio@email.com', 'Presidenza', true);
call aggiungi_utenti('testDocente', 'testDocente', '2000-1-1', 'test.docente@email.com', 'Docente', true);
call aggiungi_utenti('testStudente', 'testStudente', '2000-1-1', 'test.studente@email.com', 'Studente', true);

