#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: UTILISATEUR
#------------------------------------------------------------

CREATE TABLE UTILISATEUR(
        id_utilisateur Int  Auto_increment  NOT NULL ,
        nom            Varchar (70) NOT NULL ,
        prenom         Varchar (70) NOT NULL ,
        email          Varchar (70) NOT NULL ,
        pseudo         Varchar (70) NOT NULL , UNIQUE ,
        password       Varchar (70) NOT NULL
	,CONSTRAINT UTILISATEUR_PK PRIMARY KEY (id_utilisateur)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: TACHE
#------------------------------------------------------------

CREATE TABLE TACHE(
        id_tache       Int  Auto_increment  NOT NULL ,
        description    Varchar (255) NOT NULL ,
        date_limite    Datetime NOT NULL ,
        id_utilisateur Int NOT NULL
	,CONSTRAINT TACHE_PK PRIMARY KEY (id_tache)

	,CONSTRAINT TACHE_UTILISATEUR_FK FOREIGN KEY (id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur)
)ENGINE=InnoDB;

