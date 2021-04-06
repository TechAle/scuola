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
    token varchar(30),
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
    Prmnome varchar(30)
)
BEGIN
    INSERT INTO LAVORO(nome)
    VALUES (Prmnome);
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
    gradoText varchar(30),
    PRMtoken varchar(30)
)
BEGIN

    SET @s = (select getLavoroIdx(gradoText));

    INSERT INTO UTENTI(nome, cognome, datanascita, email, grado, abilitato, token)
    VALUES (PRMnome, PRMcognome, PRMdatanascita, PRMemail, @s, false, PRMtoken);
END
//
DELIMITER ;

drop procedure if exists aggiungi_circolari;
DELIMITER
//
CREATE PROCEDURE aggiungi_circolari (
    PRMtitolo varchar(30),
    gradoText varchar(30)
)
BEGIN
    IF gradoText like 'Entrambi' THEN
        SET @s = -1;
    ELSE
        SET @s = (select getLavoroIdx(gradoText));
    END IF;

    INSERT INTO CIRCOLARI(nome, diretto)
    VALUES (PRMtitolo, @s);
END
//
DELIMITER ;

drop procedure if exists abilita_utenti;
DELIMITER
//
CREATE PROCEDURE abilita_utenti(
    prmId int unsigned,
    passwordPRM varchar(30),
    PRMtoken varchar(30),
    out success integer
)
BEGIN
    SET success = 0;
    if (PRMtoken like (select token from UTENTI where prmId = idutente)) THEN
        SET success = 1;
        update UTENTI
            SET password = passwordPRM
        where idutente = prmId;
        update UTENTI
            SET abilitato = true
        where idutente = prmId;
    end if;

    SELECT success;
end //
DELIMITER ;


CALL aggiungi_lavoro('Amministratore');
CALL aggiungi_lavoro('Presidenza');
CALL aggiungi_lavoro('Docente');
CALL aggiungi_lavoro('Studente');

call aggiungi_utenti('Paolo', 'Ferro', '1957-06-10', 'paolo.ferro@email.com', 'Amministratore', 'a');
call abilita_utenti(1, 'demo', 'a', @success);
call aggiungi_utenti('Mario', 'Giacomo', '1954-03-10', 'mario.giacomo@email.com', 'Amministratore', 'b');
call abilita_utenti(2, 'demo', 'b', @success);
call aggiungi_utenti('Giacomo', 'Viotti', '1999-11-2', 'giacomo.viotti@email.com', 'Presidenza', 'c');
call abilita_utenti(3, 'demo', 'c', @success);
call aggiungi_utenti('Lollo', 'Caio', '2001-2-3', 'lollo.caio@email.com', 'Presidenza', 'd');
call abilita_utenti(4, 'demo', 'd', @success);
call aggiungi_utenti('testDocente', 'testDocente', '2000-1-1', 'test.docente@email.com', 'Docente', 'e');
call abilita_utenti(5, 'demo', 'e', @success);
call aggiungi_utenti('testStudente', 'testStudente', '2000-1-1', 'test.studente@email.com', 'Studente', 'f');
call abilita_utenti(6, 'demo', 'f', @success);
