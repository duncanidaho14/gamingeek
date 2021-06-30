<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210501184255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auteur (id INT AUTO_INCREMENT NOT NULL, nationalite_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, INDEX IDX_55AB1401B063272 (nationalite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jeuxvideo (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, plateforme_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prix DOUBLE PRECISION DEFAULT NULL, INDEX IDX_548BEC5ABCF5E72D (categorie_id), INDEX IDX_548BEC5A391E226B (plateforme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nationalite (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plateforme (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE auteur ADD CONSTRAINT FK_55AB1401B063272 FOREIGN KEY (nationalite_id) REFERENCES nationalite (id)');
        $this->addSql('ALTER TABLE jeuxvideo ADD CONSTRAINT FK_548BEC5ABCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE jeuxvideo ADD CONSTRAINT FK_548BEC5A391E226B FOREIGN KEY (plateforme_id) REFERENCES plateforme (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jeuxvideo DROP FOREIGN KEY FK_548BEC5ABCF5E72D');
        $this->addSql('ALTER TABLE auteur DROP FOREIGN KEY FK_55AB1401B063272');
        $this->addSql('ALTER TABLE jeuxvideo DROP FOREIGN KEY FK_548BEC5A391E226B');
        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE jeuxvideo');
        $this->addSql('DROP TABLE nationalite');
        $this->addSql('DROP TABLE plateforme');
    }
}
