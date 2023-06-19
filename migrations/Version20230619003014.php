<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230619003014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE oferta (id INT AUTO_INCREMENT NOT NULL, productoid_id INT DEFAULT NULL, porcentaje INT DEFAULT NULL, INDEX IDX_7479C8F2DA62E2A6 (productoid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE oferta ADD CONSTRAINT FK_7479C8F2DA62E2A6 FOREIGN KEY (productoid_id) REFERENCES producto (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE oferta DROP FOREIGN KEY FK_7479C8F2DA62E2A6');
        $this->addSql('DROP TABLE oferta');
    }
}
