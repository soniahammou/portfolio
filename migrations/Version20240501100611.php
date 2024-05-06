<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240501100611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pictures (id INT AUTO_INCREMENT NOT NULL, subproject VARCHAR(500) NOT NULL, project_logo VARCHAR(400) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pictures_subproject (pictures_id INT NOT NULL, subproject_id INT NOT NULL, INDEX IDX_84E95BC3BC415685 (pictures_id), INDEX IDX_84E95BC349FCF83F (subproject_id), PRIMARY KEY(pictures_id, subproject_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pictures_subproject ADD CONSTRAINT FK_84E95BC3BC415685 FOREIGN KEY (pictures_id) REFERENCES pictures (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pictures_subproject ADD CONSTRAINT FK_84E95BC349FCF83F FOREIGN KEY (subproject_id) REFERENCES subproject (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pictures_subproject DROP FOREIGN KEY FK_84E95BC3BC415685');
        $this->addSql('ALTER TABLE pictures_subproject DROP FOREIGN KEY FK_84E95BC349FCF83F');
        $this->addSql('DROP TABLE pictures');
        $this->addSql('DROP TABLE pictures_subproject');
    }
}
