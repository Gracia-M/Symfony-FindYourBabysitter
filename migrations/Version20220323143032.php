<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220323143032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE babysitter DROP FOREIGN KEY FK_9E0E090424584564');
        $this->addSql('DROP INDEX IDX_9E0E090424584564 ON babysitter');
        $this->addSql('ALTER TABLE babysitter DROP contracts_id');
        $this->addSql('ALTER TABLE contract ADD babysitter_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F28595732FB3C FOREIGN KEY (babysitter_id) REFERENCES babysitter (id)');
        $this->addSql('CREATE INDEX IDX_E98F28595732FB3C ON contract (babysitter_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE babysitter ADD contracts_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE babysitter ADD CONSTRAINT FK_9E0E090424584564 FOREIGN KEY (contracts_id) REFERENCES contract (id)');
        $this->addSql('CREATE INDEX IDX_9E0E090424584564 ON babysitter (contracts_id)');
        $this->addSql('ALTER TABLE contract DROP FOREIGN KEY FK_E98F28595732FB3C');
        $this->addSql('DROP INDEX IDX_E98F28595732FB3C ON contract');
        $this->addSql('ALTER TABLE contract DROP babysitter_id');
    }
}
