<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231103075751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_clinique_reponses DROP CONSTRAINT fk_93fccfe089e3719d');
        $this->addSql('DROP SEQUENCE reponse_validation_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE validation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE validation (id INT NOT NULL, description VARCHAR(255) DEFAULT NULL, date_creation DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN validation.date_creation IS \'(DC2Type:date_immutable)\'');
        $this->addSql('DROP TABLE reponse_validation');
        $this->addSql('DROP INDEX idx_93fccfe089e3719d');
        $this->addSql('ALTER TABLE demande_clinique_reponses RENAME COLUMN reponse_validation_id TO validation_id');
        $this->addSql('ALTER TABLE demande_clinique_reponses ADD CONSTRAINT FK_93FCCFE0A2274850 FOREIGN KEY (validation_id) REFERENCES validation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_93FCCFE0A2274850 ON demande_clinique_reponses (validation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE demande_clinique_reponses DROP CONSTRAINT FK_93FCCFE0A2274850');
        $this->addSql('DROP SEQUENCE validation_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE reponse_validation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE reponse_validation (id INT NOT NULL, description VARCHAR(255) DEFAULT NULL, date_creation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN reponse_validation.date_creation IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('DROP TABLE validation');
        $this->addSql('DROP INDEX IDX_93FCCFE0A2274850');
        $this->addSql('ALTER TABLE demande_clinique_reponses RENAME COLUMN validation_id TO reponse_validation_id');
        $this->addSql('ALTER TABLE demande_clinique_reponses ADD CONSTRAINT fk_93fccfe089e3719d FOREIGN KEY (reponse_validation_id) REFERENCES reponse_validation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_93fccfe089e3719d ON demande_clinique_reponses (reponse_validation_id)');
    }
}
