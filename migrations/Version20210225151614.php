<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210225151614 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin_agence (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin_system (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agence (id INT AUTO_INCREMENT NOT NULL, telephone VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, lattitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caissier (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, nom_complet VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, num_cni VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comptes (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, agence_id INT DEFAULT NULL, num_comptes VARCHAR(255) NOT NULL, solde INT NOT NULL, date_creation DATE NOT NULL, statut TINYINT(1) NOT NULL, INDEX IDX_56735801A76ED395 (user_id), UNIQUE INDEX UNIQ_56735801D725330D (agence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transactions (id INT AUTO_INCREMENT NOT NULL, clients_id INT DEFAULT NULL, comptes_id INT DEFAULT NULL, montant INT NOT NULL, date_depot DATE NOT NULL, date_retrait DATE NOT NULL, code_transaction VARCHAR(255) NOT NULL, frais INT NOT NULL, frais_depot INT NOT NULL, frais_retrait INT NOT NULL, frais_etat INT NOT NULL, frais_system INT NOT NULL, INDEX IDX_EAA81A4CAB014612 (clients_id), INDEX IDX_EAA81A4CDCED588B (comptes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_agence (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin_agence ADD CONSTRAINT FK_3909AB50BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE admin_system ADD CONSTRAINT FK_94852072BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE caissier ADD CONSTRAINT FK_1F038BC2BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comptes ADD CONSTRAINT FK_56735801A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comptes ADD CONSTRAINT FK_56735801D725330D FOREIGN KEY (agence_id) REFERENCES agence (id)');
        $this->addSql('ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4CAB014612 FOREIGN KEY (clients_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4CDCED588B FOREIGN KEY (comptes_id) REFERENCES comptes (id)');
        $this->addSql('ALTER TABLE user_agence ADD CONSTRAINT FK_1938194BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD profil_id INT DEFAULT NULL, ADD agence_id INT DEFAULT NULL, ADD type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D725330D FOREIGN KEY (agence_id) REFERENCES agence (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649275ED078 ON user (profil_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649D725330D ON user (agence_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comptes DROP FOREIGN KEY FK_56735801D725330D');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D725330D');
        $this->addSql('ALTER TABLE transactions DROP FOREIGN KEY FK_EAA81A4CAB014612');
        $this->addSql('ALTER TABLE transactions DROP FOREIGN KEY FK_EAA81A4CDCED588B');
        $this->addSql('DROP TABLE admin_agence');
        $this->addSql('DROP TABLE admin_system');
        $this->addSql('DROP TABLE agence');
        $this->addSql('DROP TABLE caissier');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE comptes');
        $this->addSql('DROP TABLE transactions');
        $this->addSql('DROP TABLE user_agence');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649275ED078');
        $this->addSql('DROP INDEX IDX_8D93D649275ED078 ON user');
        $this->addSql('DROP INDEX IDX_8D93D649D725330D ON user');
        $this->addSql('ALTER TABLE user DROP profil_id, DROP agence_id, DROP type');
    }
}
