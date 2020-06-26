<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200513211247 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE engagement (id INT AUTO_INCREMENT NOT NULL, num INT NOT NULL, date DATE NOT NULL, montant DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_engagement (id INT AUTO_INCREMENT NOT NULL, engagement_id INT DEFAULT NULL, num INT NOT NULL, design_art VARCHAR(255) NOT NULL, nomfour VARCHAR(255) NOT NULL, numfact INT NOT NULL, datefact DATE NOT NULL, montant DOUBLE PRECISION NOT NULL, INDEX IDX_3BC3EF5CD30F6F97 (engagement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ligne_engagement ADD CONSTRAINT FK_3BC3EF5CD30F6F97 FOREIGN KEY (engagement_id) REFERENCES engagement (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ligne_engagement DROP FOREIGN KEY FK_3BC3EF5CD30F6F97');
        $this->addSql('DROP TABLE engagement');
        $this->addSql('DROP TABLE ligne_engagement');
    }
}
