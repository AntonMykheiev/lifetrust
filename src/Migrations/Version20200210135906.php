<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200210135906 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dynamic_page DROP FOREIGN KEY FK_575ACC412469DE2');
        $this->addSql('DROP INDEX IDX_575ACC412469DE2 ON dynamic_page');
        $this->addSql('ALTER TABLE dynamic_page DROP category_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dynamic_page ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dynamic_page ADD CONSTRAINT FK_575ACC412469DE2 FOREIGN KEY (category_id) REFERENCES faq_categories (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_575ACC412469DE2 ON dynamic_page (category_id)');
    }
}
