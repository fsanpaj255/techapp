<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230619212447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE oferta DROP FOREIGN KEY FK_7479C8F2DA62E2A6');
        $this->addSql('DROP INDEX IDX_7479C8F2DA62E2A6 ON oferta');
        $this->addSql('ALTER TABLE oferta CHANGE productoid_id producto_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE oferta ADD CONSTRAINT FK_7479C8F27645698E FOREIGN KEY (producto_id) REFERENCES producto (id)');
        $this->addSql('CREATE INDEX IDX_7479C8F27645698E ON oferta (producto_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE oferta DROP FOREIGN KEY FK_7479C8F27645698E');
        $this->addSql('DROP INDEX IDX_7479C8F27645698E ON oferta');
        $this->addSql('ALTER TABLE oferta CHANGE producto_id productoid_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE oferta ADD CONSTRAINT FK_7479C8F2DA62E2A6 FOREIGN KEY (productoid_id) REFERENCES producto (id)');
        $this->addSql('CREATE INDEX IDX_7479C8F2DA62E2A6 ON oferta (productoid_id)');
    }
}
