<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220730124830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE about ADD titlemission VARCHAR(255) NOT NULL, ADD titlevision VARCHAR(255) NOT NULL, ADD descriptionmission LONGTEXT NOT NULL, ADD descriptionvision LONGTEXT NOT NULL, ADD image1 VARCHAR(255) NOT NULL, ADD image2 VARCHAR(255) NOT NULL, ADD image3 VARCHAR(255) NOT NULL, ADD image4 VARCHAR(255) NOT NULL, DROP title_mission, DROP title_vision, DROP description_mission, DROP description_vision, DROP image_1, DROP image_2, DROP image_3, DROP image_4');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE about ADD title_mission VARCHAR(255) NOT NULL, ADD title_vision VARCHAR(255) NOT NULL, ADD description_mission LONGTEXT NOT NULL, ADD description_vision LONGTEXT NOT NULL, ADD image_1 VARCHAR(255) NOT NULL, ADD image_2 VARCHAR(255) NOT NULL, ADD image_3 VARCHAR(255) NOT NULL, ADD image_4 VARCHAR(255) NOT NULL, DROP titlemission, DROP titlevision, DROP descriptionmission, DROP descriptionvision, DROP image1, DROP image2, DROP image3, DROP image4');
    }
}
