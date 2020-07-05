<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200601042209 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, user_email VARCHAR(191) NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649550872C (user_email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE idea_ask ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE idea_ask ADD CONSTRAINT FK_2D1DE01DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_2D1DE01DA76ED395 ON idea_ask (user_id)');
        $this->addSql('ALTER TABLE idea_answer ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE idea_answer ADD CONSTRAINT FK_2C25AB4DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_2C25AB4DA76ED395 ON idea_answer (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE idea_ask DROP FOREIGN KEY FK_2D1DE01DA76ED395');
        $this->addSql('ALTER TABLE idea_answer DROP FOREIGN KEY FK_2C25AB4DA76ED395');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_2C25AB4DA76ED395 ON idea_answer');
        $this->addSql('ALTER TABLE idea_answer DROP user_id');
        $this->addSql('DROP INDEX IDX_2D1DE01DA76ED395 ON idea_ask');
        $this->addSql('ALTER TABLE idea_ask DROP user_id');
    }
}
