CREATE DATABASE Client_TP_Trimestre3;

DROP TABLE IF EXISTS CLIENT; 

Create table CLIENT(NCLI			char(4) not null,
                    NOM				char(40) not null,
                    ADRESSE         char(60) null,
                    LOCALITE        char(40) not null,
                    CATEGORIE       char(2) null,
					COMPTE			int default 0,
                constraint CLIENTPK primary key (NCLI))Engine=InnoDB;