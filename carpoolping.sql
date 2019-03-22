CREATE DATABASE carpooling;
USE carpooling;

CREATE TABLE RAUTISTI(
    IDautista int auto_increment,
    nome char(50),
    cognome char(50),
    email char(50),
    password_autista char(255),
    targa char(10),
    fotografia char(50),
    recapito_telefonico char(20),
    scadenza_patente datetime,
    numero_patente char(20),
    limite_passeggeri char(20),
    data_nascita datetime,
    luogo_nascita char(20),
    PRIMARY KEY(IDautista)
);

CREATE TABLE RVIAGGI(
    IDviaggio int auto_increment,
    citta_partenza char(20),
    citta_destinazione char(20),
    data_ora_partenza datetime,
    descrizione char(200),
    tempi_percorrenza time,
    aperto bit,
    quota float,
    Kautista int,
    PRIMARY KEY(IDviaggio),
    FOREIGN KEY(Kautista) REFERENCES RAUTISTI(IDautista)
);

CREATE TABLE RPASSEGGERI(
    IDpasseggero int auto_increment,
    nome char(50),
    cognome char(50),
    email char(50),
	password_passeggero char(255),
    codice_documento char(10),
    recapito_telefonico char(14),
    tipo_documento char(20),
    PRIMARY KEY(IDpasseggero)
);

CREATE TABLE RPARTECIPA(
    Kviaggio int,
    Kpasseggero int,
    voto_discorsivo_autista char(200),
    voto_numerico_autista int,
    voto_discorsivo_passeggero char(200),
    voto_numerico_passeggero int,
    accettato bit,
    FOREIGN KEY(Kviaggio) REFERENCES RVIAGGI(IDviaggio),
    FOREIGN KEY(Kpasseggero) REFERENCES RPASSEGGERI(IDpasseggero),
    PRIMARY KEY(Kviaggio, Kpasseggero)
);