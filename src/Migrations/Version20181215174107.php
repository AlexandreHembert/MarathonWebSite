<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181215174107 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE histoire (id INT AUTO_INCREMENT NOT NULL, genre_id INT DEFAULT NULL, user_id INT DEFAULT NULL, titre VARCHAR(100) NOT NULL, pitch TEXT NOT NULL, photo VARCHAR(256) NOT NULL, actif TINYINT(1) NOT NULL, INDEX IDX_FD74CD684296D31F (genre_id), INDEX IDX_FD74CD68A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lecture (id INT AUTO_INCREMENT NOT NULL, chapitre_id INT DEFAULT NULL, user_id INT DEFAULT NULL, histoire_id INT DEFAULT NULL, date_lecture DATETIME NOT NULL, num_sequence INT NOT NULL, INDEX IDX_C16779481FBEEF7B (chapitre_id), INDEX IDX_C1677948A76ED395 (user_id), INDEX IDX_C16779489B94373 (histoire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', password VARCHAR(255) NOT NULL, nom VARCHAR(45) NOT NULL, prenom VARCHAR(45) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chapitre (id INT AUTO_INCREMENT NOT NULL, histoire_id INT DEFAULT NULL, texte TEXT NOT NULL, titre VARCHAR(100) NOT NULL, titre_court VARCHAR(30) NOT NULL, photo VARCHAR(256) NOT NULL, question VARCHAR(256) DEFAULT NULL, premier SMALLINT NOT NULL, INDEX IDX_8C62B0259B94373 (histoire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suite (id INT AUTO_INCREMENT NOT NULL, chapitre_source_id INT DEFAULT NULL, chapitre_destination_id INT DEFAULT NULL, reponse VARCHAR(100) NOT NULL, INDEX IDX_153CE426E4C89235 (chapitre_source_id), INDEX IDX_153CE426C5905AF8 (chapitre_destination_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE histoire ADD CONSTRAINT FK_FD74CD684296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE histoire ADD CONSTRAINT FK_FD74CD68A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE lecture ADD CONSTRAINT FK_C16779481FBEEF7B FOREIGN KEY (chapitre_id) REFERENCES chapitre (id)');
        $this->addSql('ALTER TABLE lecture ADD CONSTRAINT FK_C1677948A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE lecture ADD CONSTRAINT FK_C16779489B94373 FOREIGN KEY (histoire_id) REFERENCES histoire (id)');
        $this->addSql('ALTER TABLE chapitre ADD CONSTRAINT FK_8C62B0259B94373 FOREIGN KEY (histoire_id) REFERENCES histoire (id)');
        $this->addSql('ALTER TABLE suite ADD CONSTRAINT FK_153CE426E4C89235 FOREIGN KEY (chapitre_source_id) REFERENCES chapitre (id)');
        $this->addSql('ALTER TABLE suite ADD CONSTRAINT FK_153CE426C5905AF8 FOREIGN KEY (chapitre_destination_id) REFERENCES chapitre (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lecture DROP FOREIGN KEY FK_C16779489B94373');
        $this->addSql('ALTER TABLE chapitre DROP FOREIGN KEY FK_8C62B0259B94373');
        $this->addSql('ALTER TABLE histoire DROP FOREIGN KEY FK_FD74CD68A76ED395');
        $this->addSql('ALTER TABLE lecture DROP FOREIGN KEY FK_C1677948A76ED395');
        $this->addSql('ALTER TABLE lecture DROP FOREIGN KEY FK_C16779481FBEEF7B');
        $this->addSql('ALTER TABLE suite DROP FOREIGN KEY FK_153CE426E4C89235');
        $this->addSql('ALTER TABLE suite DROP FOREIGN KEY FK_153CE426C5905AF8');
        $this->addSql('ALTER TABLE histoire DROP FOREIGN KEY FK_FD74CD684296D31F');
        $this->addSql('DROP TABLE histoire');
        $this->addSql('DROP TABLE lecture');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE chapitre');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE suite');
    }
}
