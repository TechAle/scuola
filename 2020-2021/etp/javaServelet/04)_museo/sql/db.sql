## Crea il database se non esiste
create database if not exists db11465
    CHARACTER SET =  "utf8"
    COLLATE = "utf8_unicode_ci";

## Selezioniamo il database da usare
use db11465;

# Creazione dei database
## Area
### Cancellazione tabella se esiste, facciamo un reset
drop table if exists prenotazioni;
drop table if exists area;
### Creiamo la tabella area
create table area (
    #### Valori
    areaID INTEGER PRIMARY KEY AUTO_INCREMENT,
    nome NVARCHAR(30) NOT NULL ,
    costo DECIMAL(6, 2) NOT NULL,
    colore NVARCHAR(6) NOT NULL
);
## prenotazioni
### Creiamo la tabella area
create table prenotazioni (
    #### Valori
    idPrenotazione INTEGER PRIMARY KEY AUTO_INCREMENT,
    areaID INTEGER NOT NULL , # questa è una chiave esterna
    NomeUtente NVARCHAR(30),
    Data DATE NOT NULL,
    Partecipanti INTEGER NOT NULL,
    #### Chiave esterne
    FOREIGN KEY (areaID) REFERENCES area(areaID)
);

# Creazione delle procedure
## Aggiungi Prenotazione
### Se esiste, togliamola
DROP PROCEDURE IF EXISTS aggiungi_prenotazione;
## Creiamola
DELIMITER //
CREATE PROCEDURE aggiungi_prenotazione (
    prmArea NVARCHAR(30),
    prmNome NVARCHAR(30),
    prmData DATE,
    prmPart INTEGER,
    ## Valore di ritorno
    out valido integer
)
BEGIN
    ## Settiamo il valore di ritorno a 0
    SET valido = 0;
    ## Trasformiamo il nome in id
    SET @s = (select a.areaID from area a
              where a.nome like prmArea);
    ## Controlliamo che la data è maggiore della nostra e che non abbiamo l'aula occupata
    if DATEDIFF(prmData, now()) > 0
        and
       ( select count(*) from prenotazioni p where (p.Data = prmData and p.areaID = @s)) < 1
        THEN
        ## Inseriamo e ritorniamo true
        INSERT INTO prenotazioni(areaID, NomeUtente, Data, Partecipanti)
        VALUES (@s, prmNome, prmData, prmPart);
        SET valido = (select a.costo * prmPart  from area a where a.areaID = @s);
    END IF;
    select valido;
END //
DELIMITER ;
## Aggiungiamo delle nuove aree
### Se esiste, togliamola
DROP PROCEDURE IF EXISTS aggiungi_area;
## Creiamola
DELIMITER //
CREATE PROCEDURE aggiungi_area (
    prmNome NVARCHAR(30),
    prmCosto DECIMAL(6,2),
    prmColore NVARCHAR(6)
)
BEGIN
    INSERT INTO area(NOME, COSTO, COLORE)
    VALUES (prmNome, prmCosto, prmColore);
END //
DELIMITER ;

CALL aggiungi_area('rosso', 12, 'FF0000');
CALL aggiungi_area('verde', 4, '008000');
CALL aggiungi_prenotazione('verde', 'Paolo', '2000-7-04', 2, @valido);
CALL aggiungi_prenotazione('verde', 'Paolo', '2038-7-04', 2, @valido);
CALL aggiungi_prenotazione('rosso', 'Rossi', '2038-7-04', 5, @valido);
CALL aggiungi_prenotazione('rosso', 'Giacolo', '2038-7-05', 3, @valido);