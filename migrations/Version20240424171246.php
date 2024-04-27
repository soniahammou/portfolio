<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240424171246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE subproject_logiciel (subproject_id INT NOT NULL, logiciel_id INT NOT NULL, INDEX IDX_767E7A8449FCF83F (subproject_id), INDEX IDX_767E7A84CA84195D (logiciel_id), PRIMARY KEY(subproject_id, logiciel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subproject_logiciel ADD CONSTRAINT FK_767E7A8449FCF83F FOREIGN KEY (subproject_id) REFERENCES subproject (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subproject_logiciel ADD CONSTRAINT FK_767E7A84CA84195D FOREIGN KEY (logiciel_id) REFERENCES logiciel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE logiciel_subproject DROP FOREIGN KEY FK_D4E5A992CA84195D');
        $this->addSql('ALTER TABLE logiciel_subproject DROP FOREIGN KEY FK_D4E5A99249FCF83F');
        $this->addSql('DROP TABLE logiciel_subproject');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE logiciel_subproject (logiciel_id INT NOT NULL, subproject_id INT NOT NULL, INDEX IDX_D4E5A992CA84195D (logiciel_id), INDEX IDX_D4E5A99249FCF83F (subproject_id), PRIMARY KEY(logiciel_id, subproject_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE logiciel_subproject ADD CONSTRAINT FK_D4E5A992CA84195D FOREIGN KEY (logiciel_id) REFERENCES logiciel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE logiciel_subproject ADD CONSTRAINT FK_D4E5A99249FCF83F FOREIGN KEY (subproject_id) REFERENCES subproject (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subproject_logiciel DROP FOREIGN KEY FK_767E7A8449FCF83F');
        $this->addSql('ALTER TABLE subproject_logiciel DROP FOREIGN KEY FK_767E7A84CA84195D');
        $this->addSql('DROP TABLE subproject_logiciel');
    }
}
