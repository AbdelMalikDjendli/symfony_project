<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230131095533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, creator_id INT DEFAULT NULL, player1 VARCHAR(150) NOT NULL, player2 VARCHAR(150) NOT NULL, player3 VARCHAR(150) NOT NULL, player4 VARCHAR(150) NOT NULL, player5 VARCHAR(150) NOT NULL, name VARCHAR(150) NOT NULL, INDEX IDX_C4E0A61F61220EA6 (creator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_event (team_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_FCA843E7296CD8AE (team_id), INDEX IDX_FCA843E771F7E88B (event_id), PRIMARY KEY(team_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F61220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE team_event ADD CONSTRAINT FK_FCA843E7296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_event ADD CONSTRAINT FK_FCA843E771F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event DROP team1, DROP team2, CHANGE invited invited INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F61220EA6');
        $this->addSql('ALTER TABLE team_event DROP FOREIGN KEY FK_FCA843E7296CD8AE');
        $this->addSql('ALTER TABLE team_event DROP FOREIGN KEY FK_FCA843E771F7E88B');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE team_event');
        $this->addSql('ALTER TABLE event ADD team1 VARCHAR(255) NOT NULL, ADD team2 VARCHAR(255) NOT NULL, CHANGE invited invited INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
