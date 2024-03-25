DROP DATABASE IF EXISTS KSAV;

CREATE DATABASE IF NOT EXISTS KSAV;
USE KSAV;
# -----------------------------------------------------------------------------
#       TABLE : UTILISATEUR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS UTILISATEUR
(
    IDUTILISATEUR   INTEGER(2)   NOT NULL AUTO_INCREMENT,
    IDROLE          INTEGER(2)   NOT NULL,
    PSEUDO          VARCHAR(128) NULL,
    NOM             VARCHAR(128) NULL,
    PRENOM          VARCHAR(128) NULL,
    MDP             VARCHAR(255) NULL,
    DATECREATION    DATETIME     NULL,
    DATENAISSANCE   DATE         NULL,
    SEXE            SMALLINT(1)  NULL,
    PRIMARY KEY (IDUTILISATEUR)
)
    ENGINE = InnoDB;

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE UTILISATEUR
# -----------------------------------------------------------------------------


CREATE INDEX I_FK_UTILISATEUR_ROLE
    ON UTILISATEUR (IDROLE ASC);

# -----------------------------------------------------------------------------
#       TABLE : AVIS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS AVIS
(
    IDAVIS         INTEGER(2)   NOT NULL AUTO_INCREMENT,
    POINTSNEGATIFS VARCHAR(128) NULL,
    POINTSPOSITIFS VARCHAR(128) NULL,
    DATEAVIS       DATE         NULL,
    PRIMARY KEY (IDAVIS)
)
    ENGINE = InnoDB;

# -----------------------------------------------------------------------------
#       TABLE : PRESTATION
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PRESTATION
(
    IDPRESTATION INTEGER(2)   NOT NULL AUTO_INCREMENT,
    LIBELLE      CHAR(32)     NULL,
    DESCRIPTION  VARCHAR(255) NULL,
    PRIMARY KEY (IDPRESTATION)
)
    ENGINE = InnoDB;

# -----------------------------------------------------------------------------
#       TABLE : CLIENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CLIENT
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
#       TABLE : TYPEVOYAGE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS TYPEVOYAGE
(
    IDTYPEVOYAGE INTEGER(2)   NOT NULL AUTO_INCREMENT,
    LIBELLE      VARCHAR(128) NOT NULL,
    DESCRIPTION  VARCHAR(255) NULL,
    PRIMARY KEY (IDTYPEVOYAGE)
)
    ENGINE = InnoDB;

# -----------------------------------------------------------------------------
#       TABLE : RESERVATION
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS RESERVATION
(
    IDRESERVATION CHAR(32)   NOT NULL,
    IDVOYAGE      INTEGER(2) NOT NULL,
    IDCLIENT      INTEGER(2) NOT NULL,
    IDAVIS        INTEGER(2) NOT NULL,
    PRIMARY KEY (IDRESERVATION)
)
    ENGINE = InnoDB;

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE RESERVATION
# -----------------------------------------------------------------------------


CREATE INDEX I_FK_RESERVATION_VOYAGE
    ON RESERVATION (IDVOYAGE ASC);

CREATE INDEX I_FK_RESERVATION_CLIENT
    ON RESERVATION (IDCLIENT ASC);

CREATE INDEX I_FK_RESERVATION_AVIS
    ON RESERVATION (IDAVIS ASC);

# -----------------------------------------------------------------------------
#       TABLE : MODELEVOYAGE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS MODELEVOYAGE
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
#       INDEX DE LA TABLE MODELEVOYAGE
# -----------------------------------------------------------------------------


CREATE INDEX I_FK_MODELEVOYAGE_TYPEVOYAGE
    ON MODELEVOYAGE (IDTYPEVOYAGE ASC);

# -----------------------------------------------------------------------------
#       TABLE : ROLE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ROLE
(
    IDROLE  INTEGER(2)   NOT NULL AUTO_INCREMENT,
    LIBELLE VARCHAR(128) NULL,
    PRIMARY KEY (IDROLE)
)
    ENGINE = InnoDB;

# -----------------------------------------------------------------------------
#       TABLE : VOYAGE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS VOYAGE
(
    IDVOYAGE       INTEGER(2) NOT NULL AUTO_INCREMENT,
    IDMODELEVOYAGE INTEGER(2) NOT NULL,
    DATEDEPART     DATE       NOT NULL,
    PRIMARY KEY (IDVOYAGE)
)
    ENGINE = InnoDB;

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE VOYAGE
# -----------------------------------------------------------------------------


CREATE INDEX I_FK_VOYAGE_MODELEVOYAGE
    ON VOYAGE (IDMODELEVOYAGE ASC);

# -----------------------------------------------------------------------------
#       TABLE : POSSEDER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS POSSEDER
(
    IDPRESTATION   INTEGER(2) NOT NULL,
    IDMODELEVOYAGE INTEGER(2) NOT NULL,
    PRIMARY KEY (IDPRESTATION, IDMODELEVOYAGE)
)
    ENGINE = InnoDB;

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE POSSEDER
# -----------------------------------------------------------------------------


CREATE INDEX I_FK_POSSEDER_PRESTATION
    ON POSSEDER (IDPRESTATION ASC);

CREATE INDEX I_FK_POSSEDER_MODELEVOYAGE
    ON POSSEDER (IDMODELEVOYAGE ASC);

# -----------------------------------------------------------------------------
#       TABLE : NOTE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS NOTE
(
    IDPRESTATION INTEGER(2) NOT NULL,
    IDAVIS       INTEGER(2) NOT NULL,
    NOTE         CHAR(32)   NULL,
    PRIMARY KEY (IDPRESTATION, IDAVIS)
)
    ENGINE = InnoDB;

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE NOTE
# -----------------------------------------------------------------------------


CREATE INDEX I_FK_NOTE_PRESTATION
    ON NOTE (IDPRESTATION ASC);

CREATE INDEX I_FK_NOTE_AVIS
    ON NOTE (IDAVIS ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE UTILISATEUR
    ADD FOREIGN KEY FK_UTILISATEUR_ROLE (IDROLE)
        REFERENCES ROLE (IDROLE)
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