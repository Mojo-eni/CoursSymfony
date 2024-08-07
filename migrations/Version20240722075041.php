<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240722075041 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE truc ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE truc ADD CONSTRAINT FK_149FE9B8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_149FE9B8A76ED395 ON truc (user_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE truc DROP FOREIGN KEY FK_149FE9B8A76ED395');
        $this->addSql('DROP INDEX IDX_149FE9B8A76ED395 ON truc');
        $this->addSql('ALTER TABLE truc DROP user_id');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON DEFAULT NULL');
    }
}
