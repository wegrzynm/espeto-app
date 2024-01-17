<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240117124939 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contest ADD end_date DATETIME NOT NULL, CHANGE date start_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE participant ADD last_name VARCHAR(100) NOT NULL, ADD start_date DATETIME NOT NULL, ADD end_date DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participant DROP last_name, DROP start_date, DROP end_date');
        $this->addSql('ALTER TABLE contest ADD date DATETIME NOT NULL, DROP start_date, DROP end_date');
    }
}
