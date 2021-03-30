<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210320172403 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transactions ADD user_depot_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4C659D30DE FOREIGN KEY (user_depot_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_EAA81A4C659D30DE ON transactions (user_depot_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transactions DROP FOREIGN KEY FK_EAA81A4C659D30DE');
        $this->addSql('DROP INDEX IDX_EAA81A4C659D30DE ON transactions');
        $this->addSql('ALTER TABLE transactions DROP user_depot_id');
    }
}
