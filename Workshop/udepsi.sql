drop table Cours;
drop table Utilisateur;
drop table Rubrique;
drop table competence;
drop table Haut_fait;
drop table Participe;
drop table Possede;
drop table Message;
drop table commentaire;


#------------------------------------------------------------
# Table: Cours 
CREATE TABLE Cours(id_cours      int (11) NOT NULL ,date_cours    Date ,horaire       Varchar (25) ,texte_cours   Longtext ,id_competence Int NOT NULL  )ENGINE=InnoDB;
#------------------------------------------------------------

#------------------------------------------------------------
# Table: Utilisateur
CREATE TABLE Utilisateur(id_user         int (11) NOT NULL , nom             Varchar (25) , prenom          Varchar (25) , pseudo          Varchar (25) ,mail            Varchar (25) , date_create     Date , num_tel         Int , avatar          Varchar (25) , niveau_user     Int , exp             BigInt , cours_propose   Int , cours_participe Int  , id_cours        Int NOT NULL , id_rubrique     Int NOT NULL , id_hf           Int NOT NULL )ENGINE=InnoDB;
#------------------------------------------------------------

#------------------------------------------------------------
# Table: Rubrique
CREATE TABLE Rubrique(  id_rubrique   int (11)  NOT NULL , image         Varchar (100) ,video         Varchar (100) , texte_r       Longtext , note_r        Float , id_competence Int NOT NULL ,  id_user       Int NOT NULL )ENGINE=InnoDB;
#------------------------------------------------------------

#------------------------------------------------------------
# Table: Competence
CREATE TABLE Competence( id_competence  int (11) NOT NULL , nom_competence Varchar (25) ,theme          Varchar (25))ENGINE=InnoDB;
#------------------------------------------------------------

#------------------------------------------------------------
# Table: Haut-fait
CREATE TABLE Haut_fait( id_hf     int (11) NOT NULL , nom_hf    Varchar (25) , value_exp Int )ENGINE=InnoDB;
#------------------------------------------------------------

#------------------------------------------------------------
# Table: Participe
CREATE TABLE Participe(id_cours Int NOT NULL ,id_user  Int NOT NULL )ENGINE=InnoDB;
#------------------------------------------------------------

#------------------------------------------------------------
# Table: Possede
CREATE TABLE Possede( niveau        Int ,  id_competence Int NOT NULL , id_user       Int NOT NULL )ENGINE=InnoDB;
#------------------------------------------------------------

#------------------------------------------------------------
# Table: Message
CREATE TABLE Message ( message             Varchar (250) , date_message        Date , id_user_envoie             Int NOT NULL , id_user_recoie Int NOT NULL )ENGINE=InnoDB;
#------------------------------------------------------------

#------------------------------------------------------------
# Table: commentaire
CREATE TABLE commentaire( id_commentaire      int (11)  NOT NULL , commentaire         Longtext NOT NULL , note_c              Float NOT NULL , date_commentaire    Date NOT NULL , id_rubrique         Int NOT NULL ,id_user_posteur        Int NOT NULL , id_user_noteur Int NOT NULL )ENGINE=InnoDB;
#------------------------------------------------------------

ALTER TABLE Cours ADD CONSTRAINT pk_id_cours PRIMARY KEY (id_cours);
ALTER TABLE Utilisateur ADD CONSTRAINT pk_id_user PRIMARY KEY (id_user);
ALTER TABLE Rubrique ADD CONSTRAINT pk_id_rubrique PRIMARY KEY (id_rubrique);
ALTER TABLE Competence ADD CONSTRAINT pk_competence PRIMARY KEY (id_competence);
ALTER TABLE Haut_fait ADD CONSTRAINT pk_id_hf PRIMARY KEY (id_hf);
ALTER TABLE Participe ADD CONSTRAINT pk_participe PRIMARY KEY (id_user,id_cours);
ALTER TABLE Possede ADD CONSTRAINT pk_possede PRIMARY KEY (id_competence, id_user);
ALTER TABLE Message ADD CONSTRAINT pk_message PRIMARY KEY (id_user_envoie,id_user_recoie);
ALTER TABLE commentaire ADD CONSTRAINT pk_commentaire PRIMARY KEY (id_rubrique, id_user_posteur, id_user_noteur);


ALTER TABLE Cours ADD CONSTRAINT FK_Cours_id_competence FOREIGN KEY (id_competence) REFERENCES Competence(id_competence);
ALTER TABLE Utilisateur ADD CONSTRAINT FK_Utilisateur_id_cours FOREIGN KEY (id_cours) REFERENCES Cours(id_cours);
ALTER TABLE Utilisateur ADD CONSTRAINT FK_Utilisateur_id_rubrique_evaluer FOREIGN KEY (id_rubrique) REFERENCES Rubrique(id_rubrique);
ALTER TABLE Utilisateur ADD CONSTRAINT FK_Utilisateur_id_hf FOREIGN KEY (id_hf) REFERENCES Haut_fait(id_hf);
ALTER TABLE Rubrique ADD CONSTRAINT FK_Rubrique_id_competence FOREIGN KEY (id_competence) REFERENCES Competence(id_competence);
ALTER TABLE Rubrique ADD CONSTRAINT FK_Rubrique_id_user_createur FOREIGN KEY (id_user) REFERENCES Utilisateur(id_user);
ALTER TABLE Participe ADD CONSTRAINT FK_Participe_id_cours FOREIGN KEY (id_cours) REFERENCES Cours(id_cours);
ALTER TABLE Participe ADD CONSTRAINT FK_Participe_id_user FOREIGN KEY (id_user) REFERENCES Utilisateur(id_user);
ALTER TABLE Possede ADD CONSTRAINT FK_Possede_id_competence FOREIGN KEY (id_competence) REFERENCES Competence(id_competence);
ALTER TABLE Possede ADD CONSTRAINT FK_Possede_id_user FOREIGN KEY (id_user) REFERENCES Utilisateur(id_user);
ALTER TABLE Message ADD CONSTRAINT FK_Message_id_user_envoie FOREIGN KEY (id_user_envoie) REFERENCES Utilisateur(id_user);
ALTER TABLE Message ADD CONSTRAINT FK_Message_id_user_recoie FOREIGN KEY (id_user_recoie) REFERENCES Utilisateur(id_user);
ALTER TABLE commentaire ADD CONSTRAINT FK_commentaire_id_rubrique FOREIGN KEY (id_rubrique) REFERENCES Rubrique(id_rubrique);
ALTER TABLE commentaire ADD CONSTRAINT FK_commentaire_id_user_posteur FOREIGN KEY (id_user_posteur) REFERENCES Utilisateur(id_user);
ALTER TABLE commentaire ADD CONSTRAINT FK_commentaire_id_user_noteur FOREIGN KEY (id_user_noteur) REFERENCES Utilisateur(id_user);
