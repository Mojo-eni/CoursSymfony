<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240722075428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE truc ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE truc ADD CONSTRAINT FK_149FE9B812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_149FE9B812469DE2 ON truc (category_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE truc DROP FOREIGN KEY FK_149FE9B812469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP INDEX IDX_149FE9B812469DE2 ON truc');
        $this->addSql('ALTER TABLE truc DROP category_id');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON DEFAULT NULL');
    }
}
