<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231102141722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE demande_clinique_depots_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE demande_clinique_reponses_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reponse_validation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE demande_clinique_depots (id INT NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, date_creation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN demande_clinique_depots.date_creation IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE demande_clinique_reponses (id INT NOT NULL, depot_id INT DEFAULT NULL, reponse_validation_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, date_creation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, type INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_93FCCFE08510D4DE ON demande_clinique_reponses (depot_id)');
        $this->addSql('CREATE INDEX IDX_93FCCFE089E3719D ON demande_clinique_reponses (reponse_validation_id)');
        $this->addSql('COMMENT ON COLUMN demande_clinique_reponses.date_creation IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE reponse_validation (id INT NOT NULL, description VARCHAR(255) DEFAULT NULL, date_creation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN reponse_validation.date_creation IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE demande_clinique_reponses ADD CONSTRAINT FK_93FCCFE08510D4DE FOREIGN KEY (depot_id) REFERENCES demande_clinique_depots (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE demande_clinique_reponses ADD CONSTRAINT FK_93FCCFE089E3719D FOREIGN KEY (reponse_validation_id) REFERENCES reponse_validation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE demande_clinique_depots_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE demande_clinique_reponses_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reponse_validation_id_seq CASCADE');
        $this->addSql('ALTER TABLE demande_clinique_reponses DROP CONSTRAINT FK_93FCCFE08510D4DE');
        $this->addSql('ALTER TABLE demande_clinique_reponses DROP CONSTRAINT FK_93FCCFE089E3719D');
        $this->addSql('DROP TABLE demande_clinique_depots');
        $this->addSql('DROP TABLE demande_clinique_reponses');
        $this->addSql('DROP TABLE reponse_validation');
    }
}
