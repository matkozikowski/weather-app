<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201201163404 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Initial Migration';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE weather (id MEDIUMINT NOT NULL AUTO_INCREMENT, country VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, temperature VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE weather');
    }
}
