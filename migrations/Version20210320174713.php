<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210320174713 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transactions ADD compte_depot_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4C7A04723 FOREIGN KEY (compte_depot_id) REFERENCES comptes (id)');
        $this->addSql('CREATE INDEX IDX_EAA81A4C7A04723 ON transactions (compte_depot_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transactions DROP FOREIGN KEY FK_EAA81A4C7A04723');
        $this->addSql('DROP INDEX IDX_EAA81A4C7A04723 ON transactions');
        $this->addSql('ALTER TABLE transactions DROP compte_depot_id');
    }
}
