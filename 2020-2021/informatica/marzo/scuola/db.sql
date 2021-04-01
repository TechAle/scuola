create DATABASE if not exists scuola;
use scuola;

drop table if exists UTENTI;
drop table if exists LAVORO;
drop table if exists CIRCOLARI;

create table CIRCOLARI (
    id int primary key auto_increment,
    nome varchar(30) not null,
    diretto varchar(30)
);

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
    PRMnome varchar(30),
    PRMcognome varchar(30),
    PRMdatanascita date,
    PRMemail varchar(30),
    gradoText varchar(30)
)
BEGIN

    SET @s = (select getLavoroIdx(gradoText));

    INSERT INTO UTENTI(nome, cognome, datanascita, email, grado, abilitato)
    VALUES (PRMnome, PRMcognome, PRMdatanascita, PRMemail, @s, false);
END
//
DELIMITER ;

drop procedure if exists abilita_utenti;
DELIMITER
//
CREATE PROCEDURE abilita_utenti(
    prmId int unsigned,
    passwordPRM varchar(30)
)
BEGIN
    update UTENTI
        SET password = passwordPRM
    where idutente = prmId;
    update UTENTI
        SET abilitato = true
    where idutente = prmId;
end //
DELIMITER ;


CALL aggiungi_lavoro('Amministratore');
CALL aggiungi_lavoro('Presidenza');
CALL aggiungi_lavoro('Docente');
CALL aggiungi_lavoro('Studente');

call aggiungi_utenti('Paolo', 'Ferro', '1957-06-10', 'paolo.ferro@email.com', 'Amministratore');
call abilita_utenti(0, 'demo');
call aggiungi_utenti('Mario', 'Giacomo', '1954-03-10', 'mario.giacomo@email.com', 'Amministratore');
call abilita_utenti(1, 'demo');
call aggiungi_utenti('Giacomo', 'Viotti', '1999-11-2', 'giacomo.viotti@email.com', 'Presidenza');
call abilita_utenti(2, 'demo');
call aggiungi_utenti('Lollo', 'Caio', '2001-2-3', 'lollo.caio@email.com', 'Presidenza');
call abilita_utenti(3, 'demo');
call aggiungi_utenti('testDocente', 'testDocente', '2000-1-1', 'test.docente@email.com', 'Docente');
call abilita_utenti(4, 'demo');
call aggiungi_utenti('testStudente', 'testStudente', '2000-1-1', 'test.studente@email.com', 'Studente');
call abilita_utenti(5, 'demo');
call abilita_utenti(6, 'demo');
