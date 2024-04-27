<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240424142323 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gallery_category (id INT AUTO_INCREMENT NOT NULL, picture VARCHAR(500) NOT NULL, home_order INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logiciel (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logiciel_subproject (logiciel_id INT NOT NULL, subproject_id INT NOT NULL, INDEX IDX_D4E5A992CA84195D (logiciel_id), INDEX IDX_D4E5A99249FCF83F (subproject_id), PRIMARY KEY(logiciel_id, subproject_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, summary VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_tags (project_id INT NOT NULL, tags_id INT NOT NULL, INDEX IDX_562D5C3E166D1F9C (project_id), INDEX IDX_562D5C3E8D7B4FB4 (tags_id), PRIMARY KEY(project_id, tags_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_gallery_category (project_id INT NOT NULL, gallery_category_id INT NOT NULL, INDEX IDX_8E440813166D1F9C (project_id), INDEX IDX_8E440813FB4AD426 (gallery_category_id), PRIMARY KEY(project_id, gallery_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_logiciel (project_id INT NOT NULL, logiciel_id INT NOT NULL, INDEX IDX_111EED47166D1F9C (project_id), INDEX IDX_111EED47CA84195D (logiciel_id), PRIMARY KEY(project_id, logiciel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subproject (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, title VARCHAR(255) NOT NULL, summary VARCHAR(255) DEFAULT NULL, subtitle VARCHAR(255) DEFAULT NULL, content VARCHAR(3000) DEFAULT NULL, picture VARCHAR(400) NOT NULL, INDEX IDX_64D17821166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE logiciel_subproject ADD CONSTRAINT FK_D4E5A992CA84195D FOREIGN KEY (logiciel_id) REFERENCES logiciel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE logiciel_subproject ADD CONSTRAINT FK_D4E5A99249FCF83F FOREIGN KEY (subproject_id) REFERENCES subproject (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_tags ADD CONSTRAINT FK_562D5C3E166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_tags ADD CONSTRAINT FK_562D5C3E8D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_gallery_category ADD CONSTRAINT FK_8E440813166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_gallery_category ADD CONSTRAINT FK_8E440813FB4AD426 FOREIGN KEY (gallery_category_id) REFERENCES gallery_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_logiciel ADD CONSTRAINT FK_111EED47166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_logiciel ADD CONSTRAINT FK_111EED47CA84195D FOREIGN KEY (logiciel_id) REFERENCES logiciel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subproject ADD CONSTRAINT FK_64D17821166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE logiciel_subproject DROP FOREIGN KEY FK_D4E5A992CA84195D');
        $this->addSql('ALTER TABLE logiciel_subproject DROP FOREIGN KEY FK_D4E5A99249FCF83F');
        $this->addSql('ALTER TABLE project_tags DROP FOREIGN KEY FK_562D5C3E166D1F9C');
        $this->addSql('ALTER TABLE project_tags DROP FOREIGN KEY FK_562D5C3E8D7B4FB4');
        $this->addSql('ALTER TABLE project_gallery_category DROP FOREIGN KEY FK_8E440813166D1F9C');
        $this->addSql('ALTER TABLE project_gallery_category DROP FOREIGN KEY FK_8E440813FB4AD426');
        $this->addSql('ALTER TABLE project_logiciel DROP FOREIGN KEY FK_111EED47166D1F9C');
        $this->addSql('ALTER TABLE project_logiciel DROP FOREIGN KEY FK_111EED47CA84195D');
        $this->addSql('ALTER TABLE subproject DROP FOREIGN KEY FK_64D17821166D1F9C');
        $this->addSql('DROP TABLE gallery_category');
        $this->addSql('DROP TABLE logiciel');
        $this->addSql('DROP TABLE logiciel_subproject');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_tags');
        $this->addSql('DROP TABLE project_gallery_category');
        $this->addSql('DROP TABLE project_logiciel');
        $this->addSql('DROP TABLE subproject');
        $this->addSql('DROP TABLE tags');
    }
}
