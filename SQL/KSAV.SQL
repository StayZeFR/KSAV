DROP DATABASE IF EXISTS KSAV;

CREATE DATABASE IF NOT EXISTS KSAV;
USE KSAV;
# -----------------------------------------------------------------------------
#       TABLE : UTILISATEUR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS utilisateur
 (
   IDUTILISATEUR INTEGER NOT NULL AUTO_INCREMENT ,
   NOM VARCHAR(128) NULL  ,
   MDP VARCHAR(255) NULL  
   , PRIMARY KEY (IDUTILISATEUR) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : AVIS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS avis
 (
   IDAVIS INTEGER NOT NULL AUTO_INCREMENT ,
   POINTSPOSITIFS VARCHAR(128) NULL  ,
   POINTSNEGATIFS VARCHAR(128) NULL  ,
   DATEAVIS DATE NULL  
   , PRIMARY KEY (IDAVIS) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : PRESTATION
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS prestation
 (
   IDPRESTATION INTEGER NOT NULL AUTO_INCREMENT ,
   LIBELLE CHAR(32) NULL  ,
   DESCRIPTION VARCHAR(255) NULL  
   , PRIMARY KEY (IDPRESTATION) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : CLIENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS client
 (
   IDCLIENT INTEGER NOT NULL AUTO_INCREMENT ,
   NOM CHAR(32) NOT NULL  ,
   PRENOM CHAR(32) NULL  ,
   ADRESSE VARCHAR(128) NULL  ,
   EMAIL CHAR(32) NULL  ,
   TEL CHAR(32) NULL  
   , PRIMARY KEY (IDCLIENT) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : TYPEVOYAGE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS typevoyage
 (
   IDTYPEVOYAGE INTEGER NOT NULL AUTO_INCREMENT ,
   LIBELLE VARCHAR(128) NOT NULL  ,
   DESCRIPTION VARCHAR(255) NULL  
   , PRIMARY KEY (IDTYPEVOYAGE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : RESERVATION
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS reservation
 (
   IDRESERVATION CHAR(32) NOT NULL  ,
   IDVOYAGE INTEGER NOT NULL  ,
   IDCLIENT INTEGER NOT NULL  ,
   IDAVIS INTEGER NOT NULL  
   , PRIMARY KEY (IDRESERVATION) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE RESERVATION
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_RESERVATION_VOYAGE
     ON reservation (IDVOYAGE ASC);

CREATE  INDEX I_FK_RESERVATION_CLIENT
     ON reservation (IDCLIENT ASC);

CREATE  INDEX I_FK_RESERVATION_AVIS
     ON reservation (IDAVIS ASC);

# -----------------------------------------------------------------------------
#       TABLE : MODELEVOYAGE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS modelevoyage
 (
   IDMODELEVOYAGE INTEGER NOT NULL AUTO_INCREMENT ,
   IDTYPEVOYAGE INTEGER NOT NULL  ,
   NOM CHAR(32) NULL  ,
   DESCRIPTION VARCHAR(255) NULL  ,
   DESTINATION VARCHAR(128) NOT NULL  ,
   TOUROPERATOR CHAR(32) NULL  
   , PRIMARY KEY (IDMODELEVOYAGE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE MODELEVOYAGE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_MODELEVOYAGE_TYPEVOYAGE
     ON modelevoyage (IDTYPEVOYAGE ASC);

# -----------------------------------------------------------------------------
#       TABLE : VOYAGE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS voyage
 (
   IDVOYAGE INTEGER NOT NULL AUTO_INCREMENT ,
   IDMODELEVOYAGE INTEGER NOT NULL  ,
   DATEDEPART DATE NOT NULL  
   , PRIMARY KEY (IDVOYAGE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE VOYAGE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_VOYAGE_MODELEVOYAGE
     ON voyage (IDMODELEVOYAGE ASC);

# -----------------------------------------------------------------------------
#       TABLE : POSSEDER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS posseder
 (
   IDPRESTATION INTEGER NOT NULL  ,
   IDMODELEVOYAGE INTEGER NOT NULL  
   , PRIMARY KEY (IDPRESTATION,IDMODELEVOYAGE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE POSSEDER
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_POSSEDER_PRESTATION
     ON posseder (IDPRESTATION ASC);

CREATE  INDEX I_FK_POSSEDER_MODELEVOYAGE
     ON posseder (IDMODELEVOYAGE ASC);

# -----------------------------------------------------------------------------
#       TABLE : NOTE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS note
 (
   IDPRESTATION INTEGER NOT NULL  ,
   IDAVIS INTEGER NOT NULL  ,
   NOTE CHAR(32) NULL  
   , PRIMARY KEY (IDPRESTATION,IDAVIS) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE NOTE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_NOTE_PRESTATION
     ON note (IDPRESTATION ASC);

CREATE  INDEX I_FK_NOTE_AVIS
     ON note (IDAVIS ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE reservation 
  ADD FOREIGN KEY FK_RESERVATION_VOYAGE (IDVOYAGE)
      REFERENCES voyage (IDVOYAGE) ;


ALTER TABLE reservation 
  ADD FOREIGN KEY FK_RESERVATION_CLIENT (IDCLIENT)
      REFERENCES client (IDCLIENT) ;


ALTER TABLE reservation 
  ADD FOREIGN KEY FK_RESERVATION_AVIS (IDAVIS)
      REFERENCES avis (IDAVIS) ;


ALTER TABLE modelevoyage 
  ADD FOREIGN KEY FK_MODELEVOYAGE_TYPEVOYAGE (IDTYPEVOYAGE)
      REFERENCES typevoyage (IDTYPEVOYAGE) ;


ALTER TABLE voyage 
  ADD FOREIGN KEY FK_VOYAGE_MODELEVOYAGE (IDMODELEVOYAGE)
      REFERENCES modelevoyage (IDMODELEVOYAGE) ;


ALTER TABLE posseder 
  ADD FOREIGN KEY FK_POSSEDER_PRESTATION (IDPRESTATION)
      REFERENCES prestation (IDPRESTATION) ;


ALTER TABLE posseder 
  ADD FOREIGN KEY FK_POSSEDER_MODELEVOYAGE (IDMODELEVOYAGE)
      REFERENCES modelevoyage (IDMODELEVOYAGE) ;


ALTER TABLE note 
  ADD FOREIGN KEY FK_NOTE_PRESTATION (IDPRESTATION)
      REFERENCES prestation (IDPRESTATION) ;


ALTER TABLE note 
  ADD FOREIGN KEY FK_NOTE_AVIS (IDAVIS)
      REFERENCES avis (IDAVIS) ;

