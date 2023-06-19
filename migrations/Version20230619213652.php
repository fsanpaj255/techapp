<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230619213652 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE oferta DROP INDEX IDX_7479C8F2DA62E2A6, ADD UNIQUE INDEX UNIQ_7479C8F2DA62E2A6 (productoid_id)');
        $this->addSql('ALTER TABLE oferta CHANGE productoid_id productoid_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE oferta DROP INDEX UNIQ_7479C8F2DA62E2A6, ADD INDEX IDX_7479C8F2DA62E2A6 (productoid_id)');
        $this->addSql('ALTER TABLE oferta CHANGE productoid_id productoid_id INT DEFAULT NULL');
    }
}
