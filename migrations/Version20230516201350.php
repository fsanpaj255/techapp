<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230516201350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE producto ADD image_name2 VARCHAR(255) DEFAULT NULL, ADD image_size2 INT DEFAULT NULL, ADD image_name3 VARCHAR(255) DEFAULT NULL, ADD image_size3 INT DEFAULT NULL, CHANGE tamano tamano VARCHAR(5) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE producto DROP image_name2, DROP image_size2, DROP image_name3, DROP image_size3, CHANGE tamano tamano VARCHAR(255) DEFAULT NULL');
    }
}
