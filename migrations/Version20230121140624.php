<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230121140624 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE test_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE billing_accounts_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE billing_currencies_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE billing_accounts (id INT NOT NULL, currency_id INT NOT NULL, name VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D214F75038248176 ON billing_accounts (currency_id)');
        $this->addSql('CREATE TABLE billing_currencies (id INT NOT NULL, code VARCHAR(255) NOT NULL, symbol VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BBA3290277153098 ON billing_currencies (code)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BBA32902ECC836F9 ON billing_currencies (symbol)');
        $this->addSql('ALTER TABLE billing_accounts ADD CONSTRAINT FK_D214F75038248176 FOREIGN KEY (currency_id) REFERENCES billing_currencies (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE billing_accounts_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE billing_currencies_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE test_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE billing_accounts DROP CONSTRAINT FK_D214F75038248176');
        $this->addSql('DROP TABLE billing_accounts');
        $this->addSql('DROP TABLE billing_currencies');
    }
}
