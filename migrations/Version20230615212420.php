<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230615212420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pedido ADD usuarioidpedido_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pedido ADD CONSTRAINT FK_C4EC16CEA6347615 FOREIGN KEY (usuarioidpedido_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_C4EC16CEA6347615 ON pedido (usuarioidpedido_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pedido DROP FOREIGN KEY FK_C4EC16CEA6347615');
        $this->addSql('DROP INDEX IDX_C4EC16CEA6347615 ON pedido');
        $this->addSql('ALTER TABLE pedido DROP usuarioidpedido_id');
    }
}
