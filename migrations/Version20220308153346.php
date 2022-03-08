<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220308153346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE babysitter_language (babysitter_id INT NOT NULL, language_id INT NOT NULL, INDEX IDX_CFEB729C5732FB3C (babysitter_id), INDEX IDX_CFEB729C82F1BAF4 (language_id), PRIMARY KEY(babysitter_id, language_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE babysitter_language ADD CONSTRAINT FK_CFEB729C5732FB3C FOREIGN KEY (babysitter_id) REFERENCES babysitter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE babysitter_language ADD CONSTRAINT FK_CFEB729C82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE babysitter ADD contracts_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE babysitter ADD CONSTRAINT FK_9E0E090424584564 FOREIGN KEY (contracts_id) REFERENCES contract (id)');
        $this->addSql('CREATE INDEX IDX_9E0E090424584564 ON babysitter (contracts_id)');
        $this->addSql('ALTER TABLE contract ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F2859A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_E98F2859A76ED395 ON contract (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE babysitter_language');
        $this->addSql('ALTER TABLE babysitter DROP FOREIGN KEY FK_9E0E090424584564');
        $this->addSql('DROP INDEX IDX_9E0E090424584564 ON babysitter');
        $this->addSql('ALTER TABLE babysitter DROP contracts_id');
        $this->addSql('ALTER TABLE contract DROP FOREIGN KEY FK_E98F2859A76ED395');
        $this->addSql('DROP INDEX IDX_E98F2859A76ED395 ON contract');
        $this->addSql('ALTER TABLE contract DROP user_id');
    }
}
