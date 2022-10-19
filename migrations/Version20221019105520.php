<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221019105520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF339162176F');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF339162176F FOREIGN KEY (class_room_id) REFERENCES class_room (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF339162176F');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF339162176F FOREIGN KEY (class_room_id) REFERENCES class_room (id)');
    }
}
