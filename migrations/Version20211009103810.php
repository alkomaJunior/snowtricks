<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211009103810 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `groups` (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `images` (id INT AUTO_INCREMENT NOT NULL, trick_id INT DEFAULT NULL, image_file_name VARCHAR(255) DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_E01FBE6AB281BE2E (trick_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `tricks` (id INT AUTO_INCREMENT NOT NULL, trick_group_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_E1D902C19B875DF8 (trick_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `videos` (id INT AUTO_INCREMENT NOT NULL, trick_id INT DEFAULT NULL, video_file_name VARCHAR(255) DEFAULT NULL, video_url VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_29AA6432B281BE2E (trick_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `images` ADD CONSTRAINT FK_E01FBE6AB281BE2E FOREIGN KEY (trick_id) REFERENCES `tricks` (id)');
        $this->addSql('ALTER TABLE `tricks` ADD CONSTRAINT FK_E1D902C19B875DF8 FOREIGN KEY (trick_group_id) REFERENCES `groups` (id)');
        $this->addSql('ALTER TABLE `videos` ADD CONSTRAINT FK_29AA6432B281BE2E FOREIGN KEY (trick_id) REFERENCES `tricks` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `tricks` DROP FOREIGN KEY FK_E1D902C19B875DF8');
        $this->addSql('ALTER TABLE `images` DROP FOREIGN KEY FK_E01FBE6AB281BE2E');
        $this->addSql('ALTER TABLE `videos` DROP FOREIGN KEY FK_29AA6432B281BE2E');
        $this->addSql('DROP TABLE `groups`');
        $this->addSql('DROP TABLE `images`');
        $this->addSql('DROP TABLE `tricks`');
        $this->addSql('DROP TABLE `videos`');
    }
}
