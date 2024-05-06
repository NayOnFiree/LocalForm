<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240505204644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participant (session INT DEFAULT NULL, utilisateur VARCHAR(255) DEFAULT NULL, idParticipant INT AUTO_INCREMENT NOT NULL, date_ajout DATE NOT NULL, role VARCHAR(255) NOT NULL, INDEX IDX_D79F6B11D044D5D4 (session), INDEX IDX_D79F6B111D1C63B3 (utilisateur), PRIMARY KEY(idParticipant)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle (idSalle INT AUTO_INCREMENT NOT NULL, taille_salle INT NOT NULL, nom_salle VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, code_postal INT NOT NULL, PRIMARY KEY(idSalle)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (salle INT DEFAULT NULL, idSession INT AUTO_INCREMENT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_D044D5D44E977E5C (salle), PRIMARY KEY(idSession)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (nni VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, num_telephone VARCHAR(10) NOT NULL, lst_roles LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', is_active TINYINT(1) NOT NULL, PRIMARY KEY(nni)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11D044D5D4 FOREIGN KEY (session) REFERENCES session (idSession)');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B111D1C63B3 FOREIGN KEY (utilisateur) REFERENCES utilisateur (nni)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D44E977E5C FOREIGN KEY (salle) REFERENCES salle (idSalle)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B11D044D5D4');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B111D1C63B3');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D44E977E5C');
        $this->addSql('DROP TABLE participant');
        $this->addSql('DROP TABLE salle');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE utilisateur');
    }
}
