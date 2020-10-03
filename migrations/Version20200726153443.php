<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200726153443 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matche ADD type_match_id INT DEFAULT NULL, ADD niveux_match_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matche ADD CONSTRAINT FK_9FCAD510E7418B2A FOREIGN KEY (type_match_id) REFERENCES type_matche (id)');
        $this->addSql('ALTER TABLE matche ADD CONSTRAINT FK_9FCAD5107869509C FOREIGN KEY (niveux_match_id) REFERENCES rank (id)');
        $this->addSql('CREATE INDEX IDX_9FCAD510E7418B2A ON matche (type_match_id)');
        $this->addSql('CREATE INDEX IDX_9FCAD5107869509C ON matche (niveux_match_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matche DROP FOREIGN KEY FK_9FCAD510E7418B2A');
        $this->addSql('ALTER TABLE matche DROP FOREIGN KEY FK_9FCAD5107869509C');
        $this->addSql('DROP INDEX IDX_9FCAD510E7418B2A ON matche');
        $this->addSql('DROP INDEX IDX_9FCAD5107869509C ON matche');
        $this->addSql('ALTER TABLE matche DROP type_match_id, DROP niveux_match_id');
    }
}
