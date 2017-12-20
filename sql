CREATE TABLE Lieu(
        Lieu Varchar (25) NOT NULL ,
       CONSTRAINT pk_Lieu PRIMARY KEY (Lieu )
);


CREATE TABLE Marche(
        code_marche  Varchar (25) NOT NULL ,
        date_marche Date ,
        Lieu        Varchar (25) ,
       CONSTRAINT pk_Marche PRIMARY KEY (code_marche ),
	   CONSTRAINT fk_Marche FOREIGN KEY (Lieu) REFERENCES Lieu (Lieu)
);

CREATE TABLE ANNEE(
        annee                Varchar (4) NOT NULL ,
        PrixCotisationAdulte Varchar (25) ,
        PrixCotisationMineu  Varchar (25) ,
       CONSTRAINT pk_ANNEE PRIMARY KEY (annee )
);

CREATE TABLE ADHERENT(
        code_adherent          Varchar (25) NOT NULL ,
        nom_adherent           Varchar (25) ,
        prenom_adherent        Varchar (25) ,
        dateNaissance_adherent Date ,
		CONSTRAINT pk_ADHERENT PRIMARY KEY (code_adherent)
);
 
CREATE TABLE Payer_Cotisation(
        annee         Varchar (4) NOT NULL ,
        code_adherent Varchar NOT NULL ,
        CONSTRAINT pk_Payer_Cotisation PRIMARY KEY (annee ,code_adherent ),
		CONSTRAINT FK_Payer_Cotisation_annee FOREIGN KEY (annee) REFERENCES ANNEE(annee),
		CONSTRAINT FK_Payer_Cotisation_code_adherent FOREIGN KEY (code_adherent) REFERENCES ADHERENT(code_adherent)
);

CREATE TABLE Realiser(
        code_adherent  Varchar   NOT NULL ,
        code_marche    Varchar (25) NOT NULL ,
      CONSTRAINT pk_Realiser  PRIMARY KEY (code_adherent ,code_marche ),
	  CONSTRAINT FK_Realiser_code_adherent FOREIGN KEY (code_adherent) REFERENCES ADHERENT(code_adherent),
	  CONSTRAINT FK_Realiser_code_march FOREIGN KEY (code_marche) REFERENCES Marche(code_marche)
);



