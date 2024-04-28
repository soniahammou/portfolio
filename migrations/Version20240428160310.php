<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240428160310 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image_subproject (id INT AUTO_INCREMENT NOT NULL, picture VARCHAR(400) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_subproject_subproject (image_subproject_id INT NOT NULL, subproject_id INT NOT NULL, INDEX IDX_ACE7D288DF21A34 (image_subproject_id), INDEX IDX_ACE7D28849FCF83F (subproject_id), PRIMARY KEY(image_subproject_id, subproject_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image_subproject_subproject ADD CONSTRAINT FK_ACE7D288DF21A34 FOREIGN KEY (image_subproject_id) REFERENCES image_subproject (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_subproject_subproject ADD CONSTRAINT FK_ACE7D28849FCF83F FOREIGN KEY (subproject_id) REFERENCES subproject (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subproject DROP picture');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_subproject_subproject DROP FOREIGN KEY FK_ACE7D288DF21A34');
        $this->addSql('ALTER TABLE image_subproject_subproject DROP FOREIGN KEY FK_ACE7D28849FCF83F');
        $this->addSql('DROP TABLE image_subproject');
        $this->addSql('DROP TABLE image_subproject_subproject');
        $this->addSql('ALTER TABLE subproject ADD picture VARCHAR(400) NOT NULL');
    }
}
