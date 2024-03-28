DROP DATABASE IF EXISTS ksav;

CREATE DATABASE IF NOT EXISTS ksav;
USE ksav;
# -----------------------------------------------------------------------------
#       TABLE : utilisateur
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS utilisateur
(
    IDUTILISATEUR INTEGER(2)   NOT NULL AUTO_INCREMENT,
    IDROLE        INTEGER(2)   NOT NULL,
    PSEUDO        VARCHAR(128) NULL,
    NOM           VARCHAR(128) NULL,
    PRENOM        VARCHAR(128) NULL,
    MDP           VARCHAR(255) NULL,
    DATECREATION  DATETIME     NULL,
    DATENAISSANCE DATE         NULL,
    SEXE          SMALLINT(1)  NULL,
    PRIMARY KEY (IDUTILISATEUR)
)
    ENGINE = InnoDB;

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE utilisateur
# -----------------------------------------------------------------------------


CREATE INDEX I_FK_UTILISATEUR_ROLE
    ON utilisateur (IDROLE ASC);

# -----------------------------------------------------------------------------
#       TABLE : avis
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS avis
(
    IDAVIS         INTEGER(2)   NOT NULL AUTO_INCREMENT,
    POINTSNEGATIFS VARCHAR(128) NULL,
    POINTSPOSITIFS VARCHAR(128) NULL,
    DATEAVIS       DATE         NULL,
    PRIMARY KEY (IDAVIS)
)
    ENGINE = InnoDB;

# -----------------------------------------------------------------------------
#       TABLE : prestation
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS prestation
(
    IDPRESTATION INTEGER(2)   NOT NULL AUTO_INCREMENT,
    LIBELLE      CHAR(32)     NULL,
    DESCRIPTION  VARCHAR(255) NULL,
    PRIMARY KEY (IDPRESTATION)
)
    ENGINE = InnoDB;

# -----------------------------------------------------------------------------
#       TABLE : client
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS client
(
    IDCLIENT INTEGER(2)   NOT NULL AUTO_INCREMENT,
    NOM      CHAR(32)     NOT NULL,
    PRENOM   CHAR(32)     NULL,
    ADRESSE  VARCHAR(128) NULL,
    EMAIL    CHAR(32)     NULL,
    TEL      CHAR(32)     NULL,
    PRIMARY KEY (IDCLIENT)
)
    ENGINE = InnoDB;

# -----------------------------------------------------------------------------
#       TABLE : typevoyage
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS typevoyage
(
    IDTYPEVOYAGE INTEGER(2)   NOT NULL AUTO_INCREMENT,
    LIBELLE      VARCHAR(128) NOT NULL,
    DESCRIPTION  VARCHAR(255) NULL,
    PRIMARY KEY (IDTYPEVOYAGE)
)
    ENGINE = InnoDB;

# -----------------------------------------------------------------------------
#       TABLE : reservation
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS reservation
(
    IDRESERVATION CHAR(32)   NOT NULL,
    IDVOYAGE      INTEGER(2) NOT NULL,
    IDCLIENT      INTEGER(2) NOT NULL,
    IDAVIS        INTEGER(2) NOT NULL,
    PRIMARY KEY (IDRESERVATION)
)
    ENGINE = InnoDB;

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE reservation
# -----------------------------------------------------------------------------


CREATE INDEX I_FK_RESERVATION_VOYAGE
    ON reservation (IDVOYAGE ASC);

CREATE INDEX I_FK_RESERVATION_CLIENT
    ON reservation (IDCLIENT ASC);

CREATE INDEX I_FK_RESERVATION_AVIS
    ON reservation (IDAVIS ASC);

# -----------------------------------------------------------------------------
#       TABLE : modelevoyage
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS modelevoyage
(
    IDMODELEVOYAGE INTEGER(2)   NOT NULL AUTO_INCREMENT,
    IDTYPEVOYAGE   INTEGER(2)   NOT NULL,
    NOM            CHAR(32)     NULL,
    DESCRIPTION    VARCHAR(255) NULL,
    DESTINATION    VARCHAR(128) NOT NULL,
    TOUROPERATOR   CHAR(32)     NULL,
    PRIMARY KEY (IDMODELEVOYAGE)
)
    ENGINE = InnoDB;

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE modelevoyage
# -----------------------------------------------------------------------------


CREATE INDEX I_FK_MODELEVOYAGE_TYPEVOYAGE
    ON modelevoyage (IDTYPEVOYAGE ASC);

# -----------------------------------------------------------------------------
#       TABLE : role
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS role
(
    IDROLE  INTEGER(2)   NOT NULL AUTO_INCREMENT,
    LIBELLE VARCHAR(128) NULL,
    PRIMARY KEY (IDROLE)
)
    ENGINE = InnoDB;

# -----------------------------------------------------------------------------
#       TABLE : voyage
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS voyage
(
    IDVOYAGE       INTEGER(2) NOT NULL AUTO_INCREMENT,
    IDMODELEVOYAGE INTEGER(2) NOT NULL,
    DATEDEPART     DATE       NOT NULL,
    PRIMARY KEY (IDVOYAGE)
)
    ENGINE = InnoDB;

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE voyage
# -----------------------------------------------------------------------------


CREATE INDEX I_FK_VOYAGE_MODELEVOYAGE
    ON voyage (IDMODELEVOYAGE ASC);

# -----------------------------------------------------------------------------
#       TABLE : posseder
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS posseder
(
    IDPRESTATION   INTEGER(2) NOT NULL,
    IDMODELEVOYAGE INTEGER(2) NOT NULL,
    PRIMARY KEY (IDPRESTATION, IDMODELEVOYAGE)
)
    ENGINE = InnoDB;

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE posseder
# -----------------------------------------------------------------------------


CREATE INDEX I_FK_POSSEDER_PRESTATION
    ON posseder (IDPRESTATION ASC);

CREATE INDEX I_FK_POSSEDER_MODELEVOYAGE
    ON posseder (IDMODELEVOYAGE ASC);

# -----------------------------------------------------------------------------
#       TABLE : note
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS note
(
    IDPRESTATION INTEGER(2) NOT NULL,
    IDAVIS       INTEGER(2) NOT NULL,
    NOTE         CHAR(32)   NULL,
    PRIMARY KEY (IDPRESTATION, IDAVIS)
)
    ENGINE = InnoDB;

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE note
# -----------------------------------------------------------------------------


CREATE INDEX I_FK_NOTE_PRESTATION
    ON note (IDPRESTATION ASC);

CREATE INDEX I_FK_NOTE_AVIS
    ON note (IDAVIS ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE utilisateur
    ADD FOREIGN KEY FK_UTILISATEUR_ROLE (IDROLE)
        REFERENCES role (IDROLE)
        ON DELETE CASCADE;


ALTER TABLE reservation
    ADD FOREIGN KEY FK_RESERVATION_VOYAGE (IDVOYAGE)
        REFERENCES voyage (IDVOYAGE)
        ON DELETE CASCADE;


ALTER TABLE reservation
    ADD FOREIGN KEY FK_RESERVATION_CLIENT (IDCLIENT)
        REFERENCES client (IDCLIENT)
        ON DELETE CASCADE;


ALTER TABLE reservation
    ADD FOREIGN KEY FK_RESERVATION_AVIS (IDAVIS)
        REFERENCES avis (IDAVIS)
        ON DELETE CASCADE;


ALTER TABLE modelevoyage
    ADD FOREIGN KEY FK_MODELEVOYAGE_TYPEVOYAGE (IDTYPEVOYAGE)
        REFERENCES typevoyage (IDTYPEVOYAGE)
        ON DELETE CASCADE;


ALTER TABLE voyage
    ADD FOREIGN KEY FK_VOYAGE_MODELEVOYAGE (IDMODELEVOYAGE)
        REFERENCES modelevoyage (IDMODELEVOYAGE)
        ON DELETE CASCADE;


ALTER TABLE posseder
    ADD FOREIGN KEY FK_POSSEDER_PRESTATION (IDPRESTATION)
        REFERENCES prestation (IDPRESTATION)
        ON DELETE CASCADE;


ALTER TABLE posseder
    ADD FOREIGN KEY FK_POSSEDER_MODELEVOYAGE (IDMODELEVOYAGE)
        REFERENCES modelevoyage (IDMODELEVOYAGE)
        ON DELETE CASCADE;


ALTER TABLE note
    ADD FOREIGN KEY FK_NOTE_PRESTATION (IDPRESTATION)
        REFERENCES prestation (IDPRESTATION)
        ON DELETE CASCADE;


ALTER TABLE note
    ADD FOREIGN KEY FK_NOTE_AVIS (IDAVIS)
        REFERENCES avis (IDAVIS)
        ON DELETE CASCADE;