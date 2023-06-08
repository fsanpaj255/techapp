<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230608175148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tarjeta (id INT AUTO_INCREMENT NOT NULL, usuarioid_id INT DEFAULT NULL, numerotarjeta VARCHAR(16) DEFAULT NULL, fechaexpiracion DATETIME DEFAULT NULL, cvv VARCHAR(3) DEFAULT NULL, INDEX IDX_AE90B7864B1B945C (usuarioid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tarjeta ADD CONSTRAINT FK_AE90B7864B1B945C FOREIGN KEY (usuarioid_id) REFERENCES usuario (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tarjeta DROP FOREIGN KEY FK_AE90B7864B1B945C');
        $this->addSql('DROP TABLE tarjeta');
    }
}
