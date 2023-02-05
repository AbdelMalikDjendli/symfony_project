<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230202143049 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, organizer_id INT NOT NULL, five_id INT NOT NULL, invited INT NOT NULL, level VARCHAR(100) NOT NULL, hour VARCHAR(255) NOT NULL, date VARCHAR(50) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_3BAE0AA7876C4DDA (organizer_id), INDEX IDX_3BAE0AA7B99BF64F (five_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE five (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, address VARCHAR(255) NOT NULL, price INT NOT NULL, timetable VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, creator_id INT DEFAULT NULL, player1 VARCHAR(150) NOT NULL, player2 VARCHAR(150) NOT NULL, player3 VARCHAR(150) NOT NULL, player4 VARCHAR(150) NOT NULL, player5 VARCHAR(150) NOT NULL, name VARCHAR(150) NOT NULL, INDEX IDX_C4E0A61F61220EA6 (creator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_event (team_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_FCA843E7296CD8AE (team_id), INDEX IDX_FCA843E771F7E88B (event_id), PRIMARY KEY(team_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, last_name VARCHAR(100) NOT NULL, first_name VARCHAR(50) NOT NULL, num_tel VARCHAR(255) NOT NULL, pseudo VARCHAR(100) NOT NULL, ville VARCHAR(150) NOT NULL, code_postal VARCHAR(5) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D64986CC499D (pseudo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7876C4DDA FOREIGN KEY (organizer_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7B99BF64F FOREIGN KEY (five_id) REFERENCES five (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F61220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE team_event ADD CONSTRAINT FK_FCA843E7296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_event ADD CONSTRAINT FK_FCA843E771F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7876C4DDA');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7B99BF64F');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F61220EA6');
        $this->addSql('ALTER TABLE team_event DROP FOREIGN KEY FK_FCA843E7296CD8AE');
        $this->addSql('ALTER TABLE team_event DROP FOREIGN KEY FK_FCA843E771F7E88B');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE five');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE team_event');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
