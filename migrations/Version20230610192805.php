<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230610192805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE direccion (id INT AUTO_INCREMENT NOT NULL, usuarioid_id INT NOT NULL, calle VARCHAR(50) DEFAULT NULL, codigopostal INT NOT NULL, ciudad VARCHAR(50) DEFAULT NULL, provincia VARCHAR(50) DEFAULT NULL, pais VARCHAR(50) DEFAULT NULL, INDEX IDX_F384BE954B1B945C (usuarioid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE direccion ADD CONSTRAINT FK_F384BE954B1B945C FOREIGN KEY (usuarioid_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE usuario DROP tarjeta, DROP direccion, DROP fecha_expiracion, DROP cvv, DROP ciudad, DROP codigo_postal');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE direccion DROP FOREIGN KEY FK_F384BE954B1B945C');
        $this->addSql('DROP TABLE direccion');
        $this->addSql('ALTER TABLE usuario ADD tarjeta VARCHAR(50) DEFAULT NULL, ADD direccion VARCHAR(50) DEFAULT NULL, ADD fecha_expiracion VARCHAR(5) DEFAULT NULL, ADD cvv VARCHAR(3) NOT NULL, ADD ciudad VARCHAR(255) NOT NULL, ADD codigo_postal VARCHAR(10) NOT NULL');
    }
}
