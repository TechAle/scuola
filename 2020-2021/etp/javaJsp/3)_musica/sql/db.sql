## Crea il database se non esiste
create database if not exists db11465
    CHARACTER SET =  "utf8"
    COLLATE = "utf8_unicode_ci";

## Selezioniamo il database da usare
use db11465;

# Creazione dei database
## Utenti
### Cancellazione tabella se esiste, facciamo un reset
drop table if exists utente;
### Creiamo la tabella area
create table utente (
    #### Valori
                        idUtente INTEGER PRIMARY KEY AUTO_INCREMENT,
                        username NVARCHAR(30) NOT NULL,
                        nome NVARCHAR(30) NOT NULL ,
                        cognome NVARCHAR(30) NOT NULL,
                        salt VARCHAR(32) NOT NULL,
                        password_hash VARCHAR(64) not null,
                        demo boolean not null
);

## Grani
### Cancellazione tabella se esiste, facciamo un reset
drop table if exists brani;
### Creiamo la tabella area
create table brani (
    #### Valori
                       codice INTEGER PRIMARY KEY AUTO_INCREMENT,
                       titolo NVARCHAR(30) NOT NULL ,
                       nomeCantante NVARCHAR(30) NOT NULL,
                       durata INTEGER UNSIGNED NOT NULL,
                       prezzo DECIMAL(10, 2) UNSIGNED NOT NULL
);

# Funzioni
## Funzione che, dato un username, resistuisce l'id
DROP FUNCTION IF EXISTS getUsernameIdx;
DELIMITER //
CREATE FUNCTION getUsernameIdx ( nomeIn nvarchar(30) )
    RETURNS integer unsigned

BEGIN
    SET @val = ( select idUtente from utente u where u.username like nomeIn );

    RETURN @val;
end;
//
DELIMITER ;
## Funzione che, dato un username, controlla se la password è giusta
DROP FUNCTION IF EXISTS rightPassword;
DELIMITER //
CREATE FUNCTION rightPassword ( idxNome integer, password nvarchar(30) )
    RETURNS integer unsigned

BEGIN
    SET @salt = ( select salt from utente u where u.idUtente = idxNome );
    SET @insPass = SHA2(CONCAT(@salt, password), 256);
    RETURN (select idUtente from utente u where u.idUtente = idxNome and u.password_hash like @insPass);
end;
//
DELIMITER ;

## Funzione che, dato un username, controlla se è demo
DROP FUNCTION IF EXISTS isDemo;
DELIMITER //
CREATE FUNCTION isDemo ( idxNome integer)
    RETURNS integer unsigned

BEGIN
    RETURN (select idUtente from db11465.utente u where u.idUtente = idxNome and u.demo = true);
end;
//
DELIMITER ;


# Creazione procedure
## Aggiungiamo nuove musiche
### Se esiste, togliamola
DROP PROCEDURE IF EXISTS aggiungi_musica;
## Creiamola
DELIMITER //
CREATE PROCEDURE aggiungi_musica (
    PRMtitolo NVARCHAR(30) ,
    PRMnomeCantante NVARCHAR(30),
    PRMdurata INTEGER UNSIGNED,
    PRMprezzo DECIMAL(10, 2) UNSIGNED
)
BEGIN
    INSERT INTO brani(titolo, nomeCantante, durata, prezzo)
        VALUE (PRMtitolo, PRMnomeCantante, PRMdurata, PRMprezzo);
END //
DELIMITER ;

## Aggiungiamo nuovo utente
### Se esiste, togliamola
DROP PROCEDURE IF EXISTS aggiungi_utente;
## Creiamola
DELIMITER //
CREATE PROCEDURE aggiungi_utente (
    PRMusername NVARCHAR(30),
    PRMnome NVARCHAR(30),
    PRMcognome NVARCHAR(30),
    PRMpassword NVARCHAR(30),
    PRMdemo boolean
)
BEGIN
    ## Numero casuale
    SET @s = MD5(RAND());
    ## Creazione hash + numero casuale
    SET @h = SHA2(CONCAT(@s, PRMpassword), 256);
    INSERT INTO utente(username, nome, cognome, salt, password_hash, demo)
    VALUES (PRMusername, PRMnome, PRMcognome, @s, @h, PRMdemo);
END //
DELIMITER ;

## Procedura per il login
/*
 Valori di ritorno:
 0 : Username non esistente
 1 : Password sbagliata
 2 : Login fatto con successo
 */
DROP PROCEDURE IF EXISTS login;
DELIMITER //
CREATE PROCEDURE login (
    prmUsername nvarchar(30),
    prmPassword nvarchar(30),
    ## Valore di ritorno
    out success integer
)
BEGIN
    SET @idx = (select getUsernameIdx(prmUsername));
    SET success = 0;
    if (@idx is not null ) THEN
        SET success = 1;
        SET @suc = (select rightPassword(@idx, prmPassword));
        if (@suc is not null) THEN
            SET success = 2;
        end if;
    end if;

    select success;
end; //
DELIMITER ;

## Procedura per il cambio di password
/*
 Valori di ritorno:
 0 : Username non esistente
 1 : Utente non abilitato al cambio
 2 : Password non corretta
 3 : Password cambiata
 */
DROP PROCEDURE IF EXISTS cambioPass;
DELIMITER //
CREATE PROCEDURE cambioPass (
    prmUsername nvarchar(30),
    prmPasswordVecchia nvarchar(30),
    prmPasswordNuova nvarchar(30),
    ## Valore di ritorno
    out success integer
)
BEGIN
    ## Check if it exists
    SET @idx = (select getUsernameIdx(prmUsername));
    SET success = 0;

    ## If yes
    if (@idx is not null ) THEN
        ## Check if it's enabled
        SET success = 1;

        SET @abil = (select isDemo(@idx));

        ## If yes
        if (@abil is not null) THEN
            ## Check if the password is ok
            SET success = 2;
            SET @suc = (select rightPassword(@idx, prmPasswordVecchia));
            ## If yes

            if (@suc is not null) THEN
                SET success = 3;

                SET @salt = ( select salt from utente u where u.idUtente = @idx );
                SET @insPass = SHA2(CONCAT(@salt, prmPasswordNuova), 256);
                UPDATE utente
                SET password_hash = @insPass
                where idUtente = @idx;
            end if;
        end if;


    end if;

    select success;
end; //
DELIMITER ;



## Aggiungiamo gli utenti
call aggiungi_utente('MarioRossi02', 'Mario', 'Rossi', 'mario', false);
call aggiungi_utente('Giuno', 'Giorgio', 'Giovanna', 'password', false);
call aggiungi_utente('DemoUsr', 'DemoNome', 'DemoCognome', 'demo', true);

## Aggiungiamo musiche
call aggiungi_musica('provaTitolo1', 'provaCantante1', 150, 10.25);
call aggiungi_musica('provaTitolo2', 'provaCantante2', 170, 9.25);
call aggiungi_musica('provaTitolo3', 'provaCantante3', 100, 7.25);
call aggiungi_musica('provaTitolo4', 'provaCantante4', 100, 7.25);
call aggiungi_musica('provaTitolo5', 'provaCantante5', 100, 7.25);