<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170530122433 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('CREATE TABLE user (id INT NOT NULL AUTO_INCREMENT, api_key VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO user VALUES (1, "aaaaaa"), (2, "bbbbbb")');
        $this->addSql('CREATE TABLE log (id INT NOT NULL AUTO_INCREMENT, user_id INT, api_key VARCHAR(255), create_dt TIMESTAMP DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY(id))');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('DROP TABLE user');
    }
}
