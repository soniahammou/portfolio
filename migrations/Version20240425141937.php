<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240425141937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_gallery_category DROP FOREIGN KEY FK_8E440813166D1F9C');
        $this->addSql('ALTER TABLE project_gallery_category DROP FOREIGN KEY FK_8E440813FB4AD426');
        $this->addSql('DROP TABLE project_gallery_category');
        $this->addSql('DROP TABLE gallery_category');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project_gallery_category (project_id INT NOT NULL, gallery_category_id INT NOT NULL, INDEX IDX_8E440813166D1F9C (project_id), INDEX IDX_8E440813FB4AD426 (gallery_category_id), PRIMARY KEY(project_id, gallery_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE gallery_category (id INT AUTO_INCREMENT NOT NULL, picture VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, home_order INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE project_gallery_category ADD CONSTRAINT FK_8E440813166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_gallery_category ADD CONSTRAINT FK_8E440813FB4AD426 FOREIGN KEY (gallery_category_id) REFERENCES gallery_category (id) ON DELETE CASCADE');
    }
}
