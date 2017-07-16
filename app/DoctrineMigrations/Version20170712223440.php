<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170712223440 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE roster DROP INDEX UNIQ_60B9ADF9E48FD905, ADD INDEX IDX_60B9ADF9E48FD905 (game_id)');
        $this->addSql('ALTER TABLE roster DROP INDEX UNIQ_60B9ADF999E6F5DF, ADD INDEX IDX_60B9ADF999E6F5DF (player_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE roster DROP INDEX IDX_60B9ADF9E48FD905, ADD UNIQUE INDEX UNIQ_60B9ADF9E48FD905 (game_id)');
        $this->addSql('ALTER TABLE roster DROP INDEX IDX_60B9ADF999E6F5DF, ADD UNIQUE INDEX UNIQ_60B9ADF999E6F5DF (player_id)');
    }
}
