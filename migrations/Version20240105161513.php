<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240105161513 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE recipe_has_source_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE recipe_has_source (id INT NOT NULL, recipe_id INT NOT NULL, source_id INT NOT NULL, url TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3AD6EE8B59D8A214 ON recipe_has_source (recipe_id)');
        $this->addSql('CREATE INDEX IDX_3AD6EE8B953C1C61 ON recipe_has_source (source_id)');
        $this->addSql('ALTER TABLE recipe_has_source ADD CONSTRAINT FK_3AD6EE8B59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_has_source ADD CONSTRAINT FK_3AD6EE8B953C1C61 FOREIGN KEY (source_id) REFERENCES source (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE source_recipe DROP CONSTRAINT fk_6c7794d1953c1c61');
        $this->addSql('ALTER TABLE source_recipe DROP CONSTRAINT fk_6c7794d159d8a214');
        $this->addSql('DROP TABLE source_recipe');
        $this->addSql('DROP INDEX uniq_c53d045f989d9b62');
        $this->addSql('ALTER TABLE image DROP name');
        $this->addSql('ALTER TABLE image DROP slug');
        $this->addSql('ALTER TABLE recipe_has_ingredient DROP CONSTRAINT FK_FF7A1370F8BD700D');
        $this->addSql('ALTER TABLE recipe_has_ingredient ADD CONSTRAINT FK_FF7A1370F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tag DROP priority');
        $this->addSql('ALTER TABLE unit ALTER singular TYPE VARCHAR(64)');
        $this->addSql('ALTER TABLE unit ALTER plural TYPE VARCHAR(64)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE recipe_has_source_id_seq CASCADE');
        $this->addSql('CREATE TABLE source_recipe (source_id INT NOT NULL, recipe_id INT NOT NULL, PRIMARY KEY(source_id, recipe_id))');
        $this->addSql('CREATE INDEX idx_6c7794d159d8a214 ON source_recipe (recipe_id)');
        $this->addSql('CREATE INDEX idx_6c7794d1953c1c61 ON source_recipe (source_id)');
        $this->addSql('ALTER TABLE source_recipe ADD CONSTRAINT fk_6c7794d1953c1c61 FOREIGN KEY (source_id) REFERENCES source (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE source_recipe ADD CONSTRAINT fk_6c7794d159d8a214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_has_source DROP CONSTRAINT FK_3AD6EE8B59D8A214');
        $this->addSql('ALTER TABLE recipe_has_source DROP CONSTRAINT FK_3AD6EE8B953C1C61');
        $this->addSql('DROP TABLE recipe_has_source');
        $this->addSql('ALTER TABLE tag ADD priority SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE unit ALTER singular TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE unit ALTER plural TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE image ADD name VARCHAR(128) NOT NULL');
        $this->addSql('ALTER TABLE image ADD slug VARCHAR(128) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX uniq_c53d045f989d9b62 ON image (slug)');
        $this->addSql('ALTER TABLE recipe_has_ingredient DROP CONSTRAINT fk_ff7a1370f8bd700d');
        $this->addSql('ALTER TABLE recipe_has_ingredient ADD CONSTRAINT fk_ff7a1370f8bd700d FOREIGN KEY (unit_id) REFERENCES unit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
