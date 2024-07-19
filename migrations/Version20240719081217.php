<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240719081217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE truc CHANGE statut statut TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD uuid VARCHAR(180) NOT NULL, ADD roles JSON NOT NULL, DROP login, CHANGE password password VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649D17F50A6 ON user (uuid)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE truc CHANGE statut statut TINYINT(1) DEFAULT 0');
        $this->addSql('DROP INDEX UNIQ_8D93D649D17F50A6 ON user');
        $this->addSql('ALTER TABLE user ADD login VARCHAR(25) NOT NULL, DROP uuid, DROP roles, CHANGE password password VARCHAR(25) NOT NULL');
    }
}
