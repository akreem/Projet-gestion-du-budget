<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200226170844 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE devis_vierge (id INT AUTO_INCREMENT NOT NULL, date_edition DATE NOT NULL, date_limite DATE NOT NULL, nb_devis_edit INT DEFAULT NULL, year INT NOT NULL, num INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_devis_vierge (id INT AUTO_INCREMENT NOT NULL, devis_vierge_id INT NOT NULL, produit VARCHAR(255) NOT NULL, quantite INT NOT NULL, INDEX IDX_30B90EF8FA49A0DD (devis_vierge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devis (id INT AUTO_INCREMENT NOT NULL, devis_vierge_id INT NOT NULL, total_ht DOUBLE PRECISION NOT NULL, total_tva DOUBLE PRECISION NOT NULL, total_ttc DOUBLE PRECISION NOT NULL, num INT NOT NULL, annee INT NOT NULL, nom_fournisseur VARCHAR(255) NOT NULL, addr_fournisseur VARCHAR(255) NOT NULL, matricule_fiscale_fourn INT NOT NULL, tel_fourn INT NOT NULL, fax_fourn INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_devis (id INT AUTO_INCREMENT NOT NULL, devis_id INT NOT NULL, quantite INT NOT NULL, pu_ht DOUBLE PRECISION NOT NULL, tva DOUBLE PRECISION NOT NULL, total_ht DOUBLE PRECISION NOT NULL, produit VARCHAR(255) NOT NULL, INDEX IDX_888B2F1B41DEFADA (devis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ligne_devis ADD CONSTRAINT FK_888B2F1B41DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id)');
        $this->addSql('ALTER TABLE ligne_devis_vierge ADD CONSTRAINT FK_30B90EF8FA49A0DD FOREIGN KEY (devis_vierge_id) REFERENCES devis_vierge (id)');
   //     $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BFA49A0DD FOREIGN KEY (devis_vierge_id) REFERENCES devis_vierge (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ligne_devis DROP FOREIGN KEY FK_888B2F1B41DEFADA');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BFA49A0DD');
        $this->addSql('ALTER TABLE ligne_devis_vierge DROP FOREIGN KEY FK_30B90EF8FA49A0DD');
        $this->addSql('DROP TABLE devis');
        $this->addSql('DROP TABLE devis_vierge');
        $this->addSql('DROP TABLE ligne_devis');
        $this->addSql('DROP TABLE ligne_devis_vierge');
        $this->addSql('DROP TABLE user');
    }
}
