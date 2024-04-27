<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240427164059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_tags DROP FOREIGN KEY FK_562D5C3E166D1F9C');
        $this->addSql('ALTER TABLE project_tags DROP FOREIGN KEY FK_562D5C3E8D7B4FB4');
        $this->addSql('DROP TABLE project_tags');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project_tags (project_id INT NOT NULL, tags_id INT NOT NULL, INDEX IDX_562D5C3E8D7B4FB4 (tags_id), INDEX IDX_562D5C3E166D1F9C (project_id), PRIMARY KEY(project_id, tags_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE project_tags ADD CONSTRAINT FK_562D5C3E166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_tags ADD CONSTRAINT FK_562D5C3E8D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
    }
}
