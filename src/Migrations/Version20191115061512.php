<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191115061512 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE consumer CHANGE сщтыconsumer_name consumer_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE review CHANGE consumer_id consumer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE program CHANGE academy_id academy_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE consumer CHANGE consumer_name сщтыconsumer_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE program CHANGE academy_id academy_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE review CHANGE consumer_id consumer_id INT DEFAULT NULL');
    }
}
