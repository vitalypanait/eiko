<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230121142932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE billing_operations_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE billing_operations (id INT NOT NULL, account_id INT NOT NULL, amount NUMERIC(10, 0) NOT NULL, comment TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A4733CD99B6B5FBA ON billing_operations (account_id)');
        $this->addSql('ALTER TABLE billing_operations ADD CONSTRAINT FK_A4733CD99B6B5FBA FOREIGN KEY (account_id) REFERENCES billing_accounts (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE billing_operations_id_seq CASCADE');
        $this->addSql('ALTER TABLE billing_operations DROP CONSTRAINT FK_A4733CD99B6B5FBA');
        $this->addSql('DROP TABLE billing_operations');
    }
}
