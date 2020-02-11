<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200210134301 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE faq_categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, is_active INT NOT NULL, `order` INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE faq_question_answer (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, question VARCHAR(250) NOT NULL, answer TEXT NOT NULL, is_active INT NOT NULL, INDEX IDX_8B33EA5512469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE banner (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, text VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(30) NOT NULL, description VARCHAR(200) NOT NULL, content LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE home_block (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(30) NOT NULL, content TEXT NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_us (id INT AUTO_INCREMENT NOT NULL, inquiry VARCHAR(255) NOT NULL, name VARCHAR(50) NOT NULL, email VARCHAR(200) NOT NULL, phone VARCHAR(20) NOT NULL, question TEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dynamic_page (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, url VARCHAR(50) NOT NULL, quote VARCHAR(100) NOT NULL, content LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_575ACC4F47645AE (url), INDEX IDX_575ACC412469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE button (id INT AUTO_INCREMENT NOT NULL, banner_id INT DEFAULT NULL, home_block_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, url VARCHAR(200) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_3A06AC3D684EC833 (banner_id), INDEX IDX_3A06AC3D8CE87B01 (home_block_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE faq_question_answer ADD CONSTRAINT FK_8B33EA5512469DE2 FOREIGN KEY (category_id) REFERENCES faq_categories (id)');
        $this->addSql('ALTER TABLE dynamic_page ADD CONSTRAINT FK_575ACC412469DE2 FOREIGN KEY (category_id) REFERENCES faq_categories (id)');
        $this->addSql('ALTER TABLE button ADD CONSTRAINT FK_3A06AC3D684EC833 FOREIGN KEY (banner_id) REFERENCES banner (id)');
        $this->addSql('ALTER TABLE button ADD CONSTRAINT FK_3A06AC3D8CE87B01 FOREIGN KEY (home_block_id) REFERENCES home_block (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE faq_question_answer DROP FOREIGN KEY FK_8B33EA5512469DE2');
        $this->addSql('ALTER TABLE dynamic_page DROP FOREIGN KEY FK_575ACC412469DE2');
        $this->addSql('ALTER TABLE button DROP FOREIGN KEY FK_3A06AC3D684EC833');
        $this->addSql('ALTER TABLE button DROP FOREIGN KEY FK_3A06AC3D8CE87B01');
        $this->addSql('DROP TABLE faq_categories');
        $this->addSql('DROP TABLE faq_question_answer');
        $this->addSql('DROP TABLE banner');
        $this->addSql('DROP TABLE services');
        $this->addSql('DROP TABLE home_block');
        $this->addSql('DROP TABLE contact_us');
        $this->addSql('DROP TABLE dynamic_page');
        $this->addSql('DROP TABLE button');
    }
}
