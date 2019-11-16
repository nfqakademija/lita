<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191116100446 extends AbstractMigration
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
        $this->addSql('ALTER TABLE city DROP city_address');
        $this->addSql('ALTER TABLE program_event CHANGE city_id city_id INT DEFAULT NULL, CHANGE review_id review_id INT DEFAULT NULL, CHANGE program_id program_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE program ADD program_price INT DEFAULT NULL, CHANGE academy_id academy_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE city ADD city_address VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE program DROP program_price, CHANGE academy_id academy_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE program_event CHANGE city_id city_id INT DEFAULT NULL, CHANGE review_id review_id INT DEFAULT NULL, CHANGE program_id program_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE review CHANGE consumer_id consumer_id INT DEFAULT NULL');
    }
}
