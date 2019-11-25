<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191125130342 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE review CHANGE consumer_id consumer_id INT DEFAULT NULL, CHANGE program_id program_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE city ADD program_id INT DEFAULT NULL, CHANGE academy_id academy_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B02343EB8070A FOREIGN KEY (program_id) REFERENCES program (id)');
        $this->addSql('CREATE INDEX IDX_2D5B02343EB8070A ON city (program_id)');
        $this->addSql('ALTER TABLE program_event CHANGE city_id city_id INT DEFAULT NULL, CHANGE review_id review_id INT DEFAULT NULL, CHANGE program_id program_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE program CHANGE academy_id academy_id INT DEFAULT NULL, CHANGE program_price program_price INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B02343EB8070A');
        $this->addSql('DROP INDEX IDX_2D5B02343EB8070A ON city');
        $this->addSql('ALTER TABLE city DROP program_id, CHANGE academy_id academy_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE program CHANGE academy_id academy_id INT DEFAULT NULL, CHANGE program_price program_price INT DEFAULT NULL');
        $this->addSql('ALTER TABLE program_event CHANGE city_id city_id INT DEFAULT NULL, CHANGE review_id review_id INT DEFAULT NULL, CHANGE program_id program_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE review CHANGE program_id program_id INT DEFAULT NULL, CHANGE consumer_id consumer_id INT DEFAULT NULL');
    }
}
