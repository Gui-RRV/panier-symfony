<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210524171224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products ADD COLUMN slug VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__products AS SELECT id, name, description, price, img FROM products');
        $this->addSql('DROP TABLE products');
        $this->addSql('CREATE TABLE products (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, description CLOB DEFAULT NULL, price INTEGER DEFAULT NULL, img VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO products (id, name, description, price, img) SELECT id, name, description, price, img FROM __temp__products');
        $this->addSql('DROP TABLE __temp__products');
    }
}
