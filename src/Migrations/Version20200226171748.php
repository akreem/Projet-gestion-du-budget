<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200226171748 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

      //  $this->addSql('ALTER TABLE devis CHANGE devis_vierge_id devis_vierge_id INT DEFAULT NULL');
      //  $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BFA49A0DD FOREIGN KEY (devis_vierge_id) REFERENCES devis_vierge (id)');
      //  $this->addSql('CREATE INDEX IDX_8B27C52BFA49A0DD ON devis (devis_vierge_id)');
      //  $this->addSql('ALTER TABLE devis_vierge CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

    //    $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BFA49A0DD');
    //    $this->addSql('DROP INDEX IDX_8B27C52BFA49A0DD ON devis');
     //   $this->addSql('ALTER TABLE devis CHANGE devis_vierge_id devis_vierge_id INT NOT NULL');
     //   $this->addSql('ALTER TABLE devis_vierge CHANGE id id INT NOT NULL');
    }
}
