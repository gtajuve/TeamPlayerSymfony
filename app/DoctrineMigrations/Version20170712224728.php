<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170712224728 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE roster_game');
        $this->addSql('DROP TABLE roster_player');
        $this->addSql('ALTER TABLE roster ADD game_id INT DEFAULT NULL, ADD player_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE roster ADD CONSTRAINT FK_60B9ADF9E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE roster ADD CONSTRAINT FK_60B9ADF999E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_60B9ADF9E48FD905 ON roster (game_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_60B9ADF999E6F5DF ON roster (player_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE roster_game (roster_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_2B591C5B75404483 (roster_id), INDEX IDX_2B591C5BE48FD905 (game_id), PRIMARY KEY(roster_id, game_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roster_player (roster_id INT NOT NULL, player_id INT NOT NULL, INDEX IDX_13BF7DBA75404483 (roster_id), INDEX IDX_13BF7DBA99E6F5DF (player_id), PRIMARY KEY(roster_id, player_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE roster_game ADD CONSTRAINT FK_2B591C5B75404483 FOREIGN KEY (roster_id) REFERENCES roster (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE roster_game ADD CONSTRAINT FK_2B591C5BE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE roster_player ADD CONSTRAINT FK_13BF7DBA75404483 FOREIGN KEY (roster_id) REFERENCES roster (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE roster_player ADD CONSTRAINT FK_13BF7DBA99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE roster DROP FOREIGN KEY FK_60B9ADF9E48FD905');
        $this->addSql('ALTER TABLE roster DROP FOREIGN KEY FK_60B9ADF999E6F5DF');
        $this->addSql('DROP INDEX UNIQ_60B9ADF9E48FD905 ON roster');
        $this->addSql('DROP INDEX UNIQ_60B9ADF999E6F5DF ON roster');
        $this->addSql('ALTER TABLE roster DROP game_id, DROP player_id');
    }
}
