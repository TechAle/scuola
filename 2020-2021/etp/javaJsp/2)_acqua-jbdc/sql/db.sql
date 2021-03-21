## Crea il database se non esiste
create database if not exists db11465
    CHARACTER SET =  "utf8"
    COLLATE = "utf8_unicode_ci";

## Selezioniamo il database da usare
use db11465;

# Creazione dei database
## Area
### Cancellazione tabella se esiste, facciamo un reset
drop table if exists acqua;
drop table if exists tipologia;
### Creiamo la tabella tiologia
create table tipologia (
    #### Valori
    codTip INTEGER PRIMARY KEY AUTO_INCREMENT,
    nomeTip VARCHAR(30) NOT NULL
);
## prenotazioni
### Creiamo la tabella area
create table acqua (
    #### Valori
    idProdotto INTEGER PRIMARY KEY AUTO_INCREMENT,
    codTip INTEGER NOT NULL , # questa è una chiave esterna
    NomeAcqua VARCHAR(30) not null unique ,
    Prezzo DECIMAL(10, 2) not null,
    capacita INTEGER NOT NULL,
    #### Chiave esterne
    FOREIGN KEY (codTip) REFERENCES tipologia(codTip)
);

## Procedura aggiunta tipologia
DROP PROCEDURE IF EXISTS aggiungi_tipologia;
DELIMITER //
CREATE PROCEDURE  aggiungi_tipologia (
    prmNomeTip VARCHAR(30)
)
BEGIN
    INSERT INTO tipologia(nomeTip)
    VALUE  (prmNomeTip);
END //
DELIMITER ;

## Creiamo funzione che controlla se una tipologia funziona oppure no
## E ritorna il valore del codice
drop function if exists getTipologiaIdx;
DELIMITER //
CREATE FUNCTION getTipologiaIdx( nomeIn varchar(30) )
    RETURNS INTEGER
BEGIN
   SET @s = (select count(*) from db11465.tipologia t where t.nomeTip like nomeIn);
   if @s = 0 then
        call aggiungi_tipologia(nomeIn);
        return (select count(*) from db11465.tipologia);
   end if;
   return (select distinct t.codTip from db11465.tipologia t where t.nomeTip like nomeIn);
END //
DELIMITER ;

## Procedura aggiunta tipologia
DROP PROCEDURE IF EXISTS aggiungi_tipologia;
DELIMITER //
CREATE PROCEDURE  aggiungi_tipologia (
    prmNomeTip VARCHAR(30)
)
BEGIN
    INSERT INTO tipologia(nomeTip)
        VALUE  (prmNomeTip);
END //
DELIMITER ;

## Procedura aggiunta tipologia
DROP PROCEDURE IF EXISTS aggiungi_acqua;
DELIMITER //
CREATE PROCEDURE  aggiungi_acqua (
    prmNomeTip VARCHAR(30),
    prmNomeAcqua VARCHAR(30),
    prmPrezzo DECIMAL(10, 2),
    prmCapacita INTEGER
)
BEGIN
    SET @s = (select getTipologiaIdx(prmNomeTip));
    INSERT INTO acqua(codTip, NomeAcqua, Prezzo, capacita)
        VALUE  (@s, prmNomeAcqua, prmPrezzo, prmCapacita);
END //
DELIMITER ;

call aggiungi_acqua('Naturale', 'Silvietta', 0.85, 750);
call aggiungi_acqua('Naturale', 'Rocchetta', 1.12, 1250);
call aggiungi_acqua('Frizzante', 'Montagna', 1.05, 500);
call aggiungi_acqua('Frizzante', 'Pianurosa', 1.50, 1000);

