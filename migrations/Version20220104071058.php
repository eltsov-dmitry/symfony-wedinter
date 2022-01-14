<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104071058 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sites (id INT NOT NULL, uuid UUID NOT NULL, name_male VARCHAR(255) NOT NULL, name_female VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, text JSON DEFAULT NULL, events JSON DEFAULT NULL, map_props JSON DEFAULT NULL, contacts JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN sites.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, site_id INT NOT NULL, uuid UUID NOT NULL, appeal VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, is_visit BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1483A5E9F6BD1646 ON users (site_id)');
        $this->addSql('COMMENT ON COLUMN users.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9F6BD1646 FOREIGN KEY (site_id) REFERENCES sites (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE users DROP CONSTRAINT FK_1483A5E9F6BD1646');
        $this->addSql('DROP TABLE sites');
        $this->addSql('DROP TABLE users');
    }
}
