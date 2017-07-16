<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170712215804 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE roster (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roster_game (roster_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_2B591C5B75404483 (roster_id), INDEX IDX_2B591C5BE48FD905 (game_id), PRIMARY KEY(roster_id, game_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roster_player (roster_id INT NOT NULL, player_id INT NOT NULL, INDEX IDX_13BF7DBA75404483 (roster_id), INDEX IDX_13BF7DBA99E6F5DF (player_id), PRIMARY KEY(roster_id, player_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE roster_game ADD CONSTRAINT FK_2B591C5B75404483 FOREIGN KEY (roster_id) REFERENCES roster (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE roster_game ADD CONSTRAINT FK_2B591C5BE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE roster_player ADD CONSTRAINT FK_13BF7DBA75404483 FOREIGN KEY (roster_id) REFERENCES roster (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE roster_player ADD CONSTRAINT FK_13BF7DBA99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE roster_game DROP FOREIGN KEY FK_2B591C5B75404483');
        $this->addSql('ALTER TABLE roster_player DROP FOREIGN KEY FK_13BF7DBA75404483');
        $this->addSql('DROP TABLE roster');
        $this->addSql('DROP TABLE roster_game');
        $this->addSql('DROP TABLE roster_player');
    }
}
