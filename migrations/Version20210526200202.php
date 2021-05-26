<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210526200202 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE promo DROP FOREIGN KEY promo_ibfk_1');
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY groupe_ibfk_1');
        $this->addSql('ALTER TABLE creneaux_poster DROP FOREIGN KEY creneaux_poster_ibfk_1');
        $this->addSql('ALTER TABLE creneaux_soutenance DROP FOREIGN KEY creneaux_s_id_groupe');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY etudiant_ibfk_2');
        $this->addSql('ALTER TABLE voeux DROP FOREIGN KEY voeux_ibfk_1');
        $this->addSql('ALTER TABLE creneaux_poster DROP FOREIGN KEY creneaux_poster_ibfk_2');
        $this->addSql('ALTER TABLE creneaux_soutenance DROP FOREIGN KEY creneaux_s_id_tranche');
        $this->addSql('ALTER TABLE encadre DROP FOREIGN KEY encadre_ibfk_1');
        $this->addSql('ALTER TABLE voeux DROP FOREIGN KEY voeux_ibfk_2');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY etudiant_ibfk_1');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY projet_ibfk_1');
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY publication_ibfk_1');
        $this->addSql('DROP TABLE coeff');
        $this->addSql('DROP TABLE creneaux_poster');
        $this->addSql('DROP TABLE creneaux_soutenance');
        $this->addSql('DROP TABLE date_acces_site');
        $this->addSql('DROP TABLE date_acces_sout');
        $this->addSql('DROP TABLE date_excep');
        $this->addSql('DROP TABLE encadre');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE horaire_poster');
        $this->addSql('DROP TABLE horaire_soutenance');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE promo');
        $this->addSql('DROP TABLE publication');
        $this->addSql('DROP TABLE reset');
        $this->addSql('DROP TABLE type_connexion');
        $this->addSql('DROP TABLE voeux');
        $this->addSql('ALTER TABLE evaluateur CHANGE nom_eval nom_eval VARCHAR(255) NOT NULL, CHANGE prenom_eval prenom_eval VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(180) DEFAULT NULL, CHANGE password password VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BE15FA85E7927C74 ON evaluateur (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BE15FA85AA08CB10 ON evaluateur (login)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coeff (id_coeff INT AUTO_INCREMENT NOT NULL, coeff_tut_rapport SMALLINT DEFAULT 1 NOT NULL, coeff_tut_trav SMALLINT DEFAULT 2 NOT NULL, coeff_tut_compet SMALLINT DEFAULT 2 NOT NULL, coeff_sout_qual SMALLINT DEFAULT 1 NOT NULL, coeff_sout_trav SMALLINT DEFAULT 1 NOT NULL, coeff_sout_compet SMALLINT DEFAULT 1 NOT NULL, coeff_poster_qual SMALLINT DEFAULT 1, coeff_poster_trav SMALLINT DEFAULT 1, coeff_poster_compet SMALLINT DEFAULT 1, PRIMARY KEY(id_coeff)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE creneaux_poster (id_groupe INT NOT NULL, id_tranche INT NOT NULL, INDEX horaire (id_tranche), INDEX IDX_CE27E04A228E39CC (id_groupe), PRIMARY KEY(id_groupe, id_tranche)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE creneaux_soutenance (id_groupe INT NOT NULL, id_tranche INT NOT NULL, INDEX creneaux_s_id_tranche (id_tranche), INDEX IDX_E085F9CF228E39CC (id_groupe), PRIMARY KEY(id_groupe, id_tranche)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE date_acces_site (id_d_site INT AUTO_INCREMENT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, id_co INT NOT NULL, PRIMARY KEY(id_d_site)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE date_acces_sout (id_d_sout INT AUTO_INCREMENT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, PRIMARY KEY(id_d_sout)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE date_excep (id_date_excep INT AUTO_INCREMENT NOT NULL, date_deb_excep DATE NOT NULL, date_fin_excep DATE NOT NULL, date_sout_excep DATE DEFAULT NULL, remarque VARCHAR(30) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, PRIMARY KEY(id_date_excep)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE encadre (id_projet INT NOT NULL, id_eval INT NOT NULL, INDEX encadre_ibfk_2 (id_eval), INDEX IDX_441BA2B276222944 (id_projet), PRIMARY KEY(id_projet, id_eval)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE etudiant (id_etud INT AUTO_INCREMENT NOT NULL, id_promo INT NOT NULL, id_groupe INT DEFAULT NULL, nom VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, prenom VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, demi_groupe VARCHAR(3) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, email VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, login VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, mdp VARCHAR(150) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, note_tut_rapport NUMERIC(4, 2) DEFAULT NULL, note_tut_trav NUMERIC(4, 2) DEFAULT NULL, note_tut_compet NUMERIC(4, 2) DEFAULT NULL, pourcent_travail SMALLINT DEFAULT NULL, note_tut_5 NUMERIC(4, 2) DEFAULT NULL, note_tut_20 NUMERIC(4, 2) DEFAULT NULL, note_finale NUMERIC(4, 2) DEFAULT NULL, INDEX id_groupe (id_groupe), INDEX id_promo (id_promo), PRIMARY KEY(id_etud)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE groupe (id_groupe INT AUTO_INCREMENT NOT NULL, id_date_excep INT DEFAULT NULL, numero VARCHAR(3) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, duree_diff VARCHAR(255) CHARACTER SET utf8 DEFAULT \'n\' NOT NULL COLLATE `utf8_general_ci`, heure_sout TIME DEFAULT NULL, note_sout NUMERIC(4, 2) DEFAULT \'0.00\', note_poster NUMERIC(4, 2) DEFAULT \'0.00\', id_projet INT DEFAULT NULL, INDEX id_date_excep (id_date_excep), PRIMARY KEY(id_groupe)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE horaire_poster (id_tranche INT NOT NULL, heure_debut TIME NOT NULL, heure_fin TIME NOT NULL, PRIMARY KEY(id_tranche)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE horaire_soutenance (id_tranche INT NOT NULL, horaire TIME NOT NULL, PRIMARY KEY(id_tranche)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE projet (id_projet INT AUTO_INCREMENT NOT NULL, id_promo INT NOT NULL, num_projet SMALLINT NOT NULL, titre VARCHAR(150) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, description VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, url VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, INDEX id_promo (id_promo), PRIMARY KEY(id_projet)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE promo (id_promo INT AUTO_INCREMENT NOT NULL, id_coeff INT DEFAULT NULL, annee_univ DATE NOT NULL, type_promo LONGTEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci` COMMENT \'(DC2Type:simple_array)\', nom_promo VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, date_deb DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, date_sout DATE DEFAULT NULL, INDEX id_coeff (id_coeff), PRIMARY KEY(id_promo)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE publication (id_publication INT NOT NULL, visibilite INT NOT NULL, id_promo INT NOT NULL, titre_publication VARCHAR(150) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, commentaire VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, url_publication VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, INDEX id_promo (id_promo), PRIMARY KEY(id_publication, visibilite)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reset (email VARCHAR(30) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, reset_key VARCHAR(100) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, date_expiration DATETIME NOT NULL, PRIMARY KEY(email)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE type_connexion (id_typeco INT AUTO_INCREMENT NOT NULL, type_co VARCHAR(30) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, description TEXT CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, PRIMARY KEY(id_typeco)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE voeux (id_groupe INT NOT NULL, id_projet INT NOT NULL, ordre SMALLINT DEFAULT NULL, INDEX voeux_ibfk_2 (id_projet), INDEX IDX_917F7851228E39CC (id_groupe), PRIMARY KEY(id_groupe, id_projet)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE creneaux_poster ADD CONSTRAINT creneaux_poster_ibfk_1 FOREIGN KEY (id_groupe) REFERENCES groupe (id_groupe) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE creneaux_poster ADD CONSTRAINT creneaux_poster_ibfk_2 FOREIGN KEY (id_tranche) REFERENCES horaire_poster (id_tranche) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE creneaux_soutenance ADD CONSTRAINT creneaux_s_id_groupe FOREIGN KEY (id_groupe) REFERENCES groupe (id_groupe) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE creneaux_soutenance ADD CONSTRAINT creneaux_s_id_tranche FOREIGN KEY (id_tranche) REFERENCES horaire_soutenance (id_tranche) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE encadre ADD CONSTRAINT encadre_ibfk_1 FOREIGN KEY (id_projet) REFERENCES projet (id_projet) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE encadre ADD CONSTRAINT encadre_ibfk_2 FOREIGN KEY (id_eval) REFERENCES evaluateur (id_eval) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT etudiant_ibfk_1 FOREIGN KEY (id_promo) REFERENCES promo (id_promo) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT etudiant_ibfk_2 FOREIGN KEY (id_groupe) REFERENCES groupe (id_groupe) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT groupe_ibfk_1 FOREIGN KEY (id_date_excep) REFERENCES date_excep (id_date_excep) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT projet_ibfk_1 FOREIGN KEY (id_promo) REFERENCES promo (id_promo) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE promo ADD CONSTRAINT promo_ibfk_1 FOREIGN KEY (id_coeff) REFERENCES coeff (id_coeff) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT publication_ibfk_1 FOREIGN KEY (id_promo) REFERENCES promo (id_promo) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE voeux ADD CONSTRAINT voeux_ibfk_1 FOREIGN KEY (id_groupe) REFERENCES groupe (id_groupe) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE voeux ADD CONSTRAINT voeux_ibfk_2 FOREIGN KEY (id_projet) REFERENCES projet (id_projet) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('DROP INDEX UNIQ_BE15FA85E7927C74 ON evaluateur');
        $this->addSql('DROP INDEX UNIQ_BE15FA85AA08CB10 ON evaluateur');
        $this->addSql('ALTER TABLE evaluateur CHANGE nom_eval nom_eval VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE prenom_eval prenom_eval VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE email email VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE password password VARCHAR(150) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`');
    }
}
