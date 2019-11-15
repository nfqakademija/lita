<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191114223030 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE consumer (id INT AUTO_INCREMENT NOT NULL, consumer_name VARCHAR(255) NOT NULL, consumer_lastname VARCHAR(255) NOT NULL, consumer_email VARCHAR(255) NOT NULL, consumer_password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, consumer_id INT DEFAULT NULL, review_stars VARCHAR(255) NOT NULL, review_comment LONGTEXT NOT NULL, review_data DATE NOT NULL, INDEX IDX_794381C637FDBD6D (consumer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, city VARCHAR(255) NOT NULL, city_address VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C637FDBD6D FOREIGN KEY (consumer_id) REFERENCES consumer (id)');
        $this->addSql('ALTER TABLE program CHANGE academy_id academy_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C637FDBD6D');
        $this->addSql('DROP TABLE consumer');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE city');
        $this->addSql('ALTER TABLE program CHANGE academy_id academy_id INT DEFAULT NULL');
    }
}
