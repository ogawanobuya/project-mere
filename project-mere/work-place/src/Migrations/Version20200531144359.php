<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200531144359 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE idea_ask (id INT AUTO_INCREMENT NOT NULL, idea_category_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, is_solved TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_2D1DE01D2CF6E360 (idea_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE idea_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE idea_answer (id INT AUTO_INCREMENT NOT NULL, idea_ask_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_2C25AB4D4FC76A0B (idea_ask_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE idea_ask ADD CONSTRAINT FK_2D1DE01D2CF6E360 FOREIGN KEY (idea_category_id) REFERENCES idea_category (id)');
        $this->addSql('ALTER TABLE idea_answer ADD CONSTRAINT FK_2C25AB4D4FC76A0B FOREIGN KEY (idea_ask_id) REFERENCES idea_ask (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE idea_answer DROP FOREIGN KEY FK_2C25AB4D4FC76A0B');
        $this->addSql('ALTER TABLE idea_ask DROP FOREIGN KEY FK_2D1DE01D2CF6E360');
        $this->addSql('DROP TABLE idea_ask');
        $this->addSql('DROP TABLE idea_category');
        $this->addSql('DROP TABLE idea_answer');
    }
}
