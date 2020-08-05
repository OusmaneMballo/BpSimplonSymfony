<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200805151839 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client_moral (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, raison_social VARCHAR(50) NOT NULL, addresse VARCHAR(100) DEFAULT NULL, telephone VARCHAR(20) NOT NULL, email VARCHAR(30) NOT NULL, login VARCHAR(30) NOT NULL, passwd VARCHAR(30) NOT NULL, ninea VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_physique (id INT AUTO_INCREMENT NOT NULL, type_client_id INT DEFAULT NULL, client_moral_id INT DEFAULT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, salaire DOUBLE PRECISION DEFAULT NULL, adresse VARCHAR(100) DEFAULT NULL, telephone VARCHAR(20) NOT NULL, email VARCHAR(30) NOT NULL, login VARCHAR(30) NOT NULL, passwd VARCHAR(30) NOT NULL, profession VARCHAR(30) DEFAULT NULL, nci VARCHAR(30) NOT NULL, INDEX IDX_B11F1822AD2D2831 (type_client_id), INDEX IDX_B11F1822779CC064 (client_moral_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, type_compte_id INT DEFAULT NULL, client_moral_id INT DEFAULT NULL, client_physique_id INT DEFAULT NULL, numero VARCHAR(30) NOT NULL, cle_rip VARCHAR(30) NOT NULL, etat VARCHAR(15) NOT NULL, create_at DATETIME NOT NULL, solde DOUBLE PRECISION NOT NULL, date_fermeture DATE DEFAULT NULL, date_ferm_tempo DATE DEFAULT NULL, date_reouverture DATE DEFAULT NULL, INDEX IDX_CFF6526046032730 (type_compte_id), INDEX IDX_CFF65260779CC064 (client_moral_id), INDEX IDX_CFF65260529BC2A3 (client_physique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE frais_bancaire (id INT AUTO_INCREMENT NOT NULL, type_frais_id INT DEFAULT NULL, compte_id INT DEFAULT NULL, frais DOUBLE PRECISION NOT NULL, date DATE DEFAULT NULL, INDEX IDX_E0D9213B72AE4A38 (type_frais_id), INDEX IDX_E0D9213BF2C56620 (compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_client (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_compte (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_frais (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL, frais DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_physique ADD CONSTRAINT FK_B11F1822AD2D2831 FOREIGN KEY (type_client_id) REFERENCES type_client (id)');
        $this->addSql('ALTER TABLE client_physique ADD CONSTRAINT FK_B11F1822779CC064 FOREIGN KEY (client_moral_id) REFERENCES client_moral (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526046032730 FOREIGN KEY (type_compte_id) REFERENCES type_compte (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260779CC064 FOREIGN KEY (client_moral_id) REFERENCES client_moral (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260529BC2A3 FOREIGN KEY (client_physique_id) REFERENCES client_physique (id)');
        $this->addSql('ALTER TABLE frais_bancaire ADD CONSTRAINT FK_E0D9213B72AE4A38 FOREIGN KEY (type_frais_id) REFERENCES type_frais (id)');
        $this->addSql('ALTER TABLE frais_bancaire ADD CONSTRAINT FK_E0D9213BF2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_physique DROP FOREIGN KEY FK_B11F1822779CC064');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF65260779CC064');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF65260529BC2A3');
        $this->addSql('ALTER TABLE frais_bancaire DROP FOREIGN KEY FK_E0D9213BF2C56620');
        $this->addSql('ALTER TABLE client_physique DROP FOREIGN KEY FK_B11F1822AD2D2831');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF6526046032730');
        $this->addSql('ALTER TABLE frais_bancaire DROP FOREIGN KEY FK_E0D9213B72AE4A38');
        $this->addSql('DROP TABLE client_moral');
        $this->addSql('DROP TABLE client_physique');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE frais_bancaire');
        $this->addSql('DROP TABLE type_client');
        $this->addSql('DROP TABLE type_compte');
        $this->addSql('DROP TABLE type_frais');
    }
}
