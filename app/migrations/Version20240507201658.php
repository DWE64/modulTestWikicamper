<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240507201658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE rental_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE rental (id INT NOT NULL, user_owner_id INT NOT NULL, title VARCHAR(255) NOT NULL, describe TEXT NOT NULL, price NUMERIC(10, 2) NOT NULL, localisation VARCHAR(255) NOT NULL, filename VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1619C27D9EB185F9 ON rental (user_owner_id)');
        $this->addSql('ALTER TABLE rental ADD CONSTRAINT FK_1619C27D9EB185F9 FOREIGN KEY (user_owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE rental_id_seq CASCADE');
        $this->addSql('ALTER TABLE rental DROP CONSTRAINT FK_1619C27D9EB185F9');
        $this->addSql('DROP TABLE rental');
    }
}
