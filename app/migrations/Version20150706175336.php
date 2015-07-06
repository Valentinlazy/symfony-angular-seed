<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150706175336 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_session_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, salt VARCHAR(255) NOT NULL, roles TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('COMMENT ON COLUMN users.roles IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE user_session (id INT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8849CBDE5F37A13B ON user_session (token)');
        $this->addSql('CREATE INDEX IDX_8849CBDEA76ED395 ON user_session (user_id)');
        $this->addSql('ALTER TABLE user_session ADD CONSTRAINT FK_8849CBDEA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_session DROP CONSTRAINT FK_8849CBDEA76ED395');
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_session_id_seq CASCADE');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE user_session');
    }
}
