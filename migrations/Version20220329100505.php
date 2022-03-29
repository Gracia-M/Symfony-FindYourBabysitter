<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220329100505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE babysitter (id INT AUTO_INCREMENT NOT NULL, picture VARCHAR(255) DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, gender VARCHAR(255) DEFAULT NULL, location VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, is_available TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE babysitter_language (babysitter_id INT NOT NULL, language_id INT NOT NULL, INDEX IDX_CFEB729C5732FB3C (babysitter_id), INDEX IDX_CFEB729C82F1BAF4 (language_id), PRIMARY KEY(babysitter_id, language_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contract (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, babysitter_id INT DEFAULT NULL, hour_start_contract TIME DEFAULT NULL, hour_end_contract TIME DEFAULT NULL, date_start_contract DATETIME DEFAULT NULL, date_end_contract DATETIME DEFAULT NULL, review LONGTEXT DEFAULT NULL, review_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_E98F2859A76ED395 (user_id), INDEX IDX_E98F28595732FB3C (babysitter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE babysitter_language ADD CONSTRAINT FK_CFEB729C5732FB3C FOREIGN KEY (babysitter_id) REFERENCES babysitter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE babysitter_language ADD CONSTRAINT FK_CFEB729C82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F2859A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F28595732FB3C FOREIGN KEY (babysitter_id) REFERENCES babysitter (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE babysitter_language DROP FOREIGN KEY FK_CFEB729C5732FB3C');
        $this->addSql('ALTER TABLE contract DROP FOREIGN KEY FK_E98F28595732FB3C');
        $this->addSql('ALTER TABLE babysitter_language DROP FOREIGN KEY FK_CFEB729C82F1BAF4');
        $this->addSql('ALTER TABLE contract DROP FOREIGN KEY FK_E98F2859A76ED395');
        $this->addSql('DROP TABLE babysitter');
        $this->addSql('DROP TABLE babysitter_language');
        $this->addSql('DROP TABLE contract');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
