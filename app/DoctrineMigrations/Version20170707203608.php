<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170707203608 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE player ADD nation_id INT DEFAULT NULL, ADD number VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65AE3899 FOREIGN KEY (nation_id) REFERENCES nation (id)');
        $this->addSql('CREATE INDEX IDX_98197A65AE3899 ON player (nation_id)');
        $this->addSql('ALTER TABLE team ADD nation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FAE3899 FOREIGN KEY (nation_id) REFERENCES nation (id)');
        $this->addSql('CREATE INDEX IDX_C4E0A61FAE3899 ON team (nation_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65AE3899');
        $this->addSql('DROP INDEX IDX_98197A65AE3899 ON player');
        $this->addSql('ALTER TABLE player DROP nation_id, DROP number');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61FAE3899');
        $this->addSql('DROP INDEX IDX_C4E0A61FAE3899 ON team');
        $this->addSql('ALTER TABLE team DROP nation_id');
    }
}
