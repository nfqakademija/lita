<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191115115435 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE review CHANGE consumer_id consumer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE program_event ADD city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE program_event ADD CONSTRAINT FK_A5C779518BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_A5C779518BAC62AF ON program_event (city_id)');
        $this->addSql('ALTER TABLE program CHANGE academy_id academy_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE program CHANGE academy_id academy_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE program_event DROP FOREIGN KEY FK_A5C779518BAC62AF');
        $this->addSql('DROP INDEX IDX_A5C779518BAC62AF ON program_event');
        $this->addSql('ALTER TABLE program_event DROP city_id');
        $this->addSql('ALTER TABLE review CHANGE consumer_id consumer_id INT DEFAULT NULL');
    }
}
