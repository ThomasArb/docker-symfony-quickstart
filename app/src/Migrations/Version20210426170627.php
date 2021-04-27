<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * This migration add the table used to store the callback requests
 */
final class Version20210426170627 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Add the Callback entity to the database';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE callback_request (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(64) NOT NULL, last_name VARCHAR(64) NOT NULL, country VARCHAR(16) NOT NULL, national_phone_number VARCHAR(32) NOT NULL, international_phone_number VARCHAR(32) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE callback_request');
    }
}
