<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240105060251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '1- création de schéma de base';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE image_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ingredient_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ingredient_group_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE recipe_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE recipe_has_ingredient_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE source_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE step_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tag_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE unit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE image (id INT NOT NULL, step_id INT DEFAULT NULL, recipe_id INT DEFAULT NULL, path VARCHAR(255) NOT NULL, size INT NOT NULL, name VARCHAR(128) NOT NULL, slug VARCHAR(128) NOT NULL, description TEXT DEFAULT NULL, priority SMALLINT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C53D045F989D9B62 ON image (slug)');
        $this->addSql('CREATE INDEX IDX_C53D045F73B21E9C ON image (step_id)');
        $this->addSql('CREATE INDEX IDX_C53D045F59D8A214 ON image (recipe_id)');
        $this->addSql('CREATE TABLE ingredient (id INT NOT NULL, vegan BOOLEAN NOT NULL, vegetarian BOOLEAN NOT NULL, dairy_free BOOLEAN NOT NULL, gluten_free BOOLEAN NOT NULL, name VARCHAR(128) NOT NULL, slug VARCHAR(128) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6BAF7870989D9B62 ON ingredient (slug)');
        $this->addSql('CREATE TABLE ingredient_group (id INT NOT NULL, name VARCHAR(128) NOT NULL, slug VARCHAR(128) NOT NULL, priority SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_74F22304989D9B62 ON ingredient_group (slug)');
        $this->addSql('CREATE TABLE recipe (id INT NOT NULL, draft BOOLEAN NOT NULL, cooking SMALLINT DEFAULT NULL, break SMALLINT DEFAULT NULL, preparation SMALLINT DEFAULT NULL, name VARCHAR(128) NOT NULL, slug VARCHAR(128) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DA88B137989D9B62 ON recipe (slug)');
        $this->addSql('CREATE TABLE recipe_has_ingredient (id INT NOT NULL, ingredient_id INT NOT NULL, unit_id INT DEFAULT NULL, ingredient_group_id INT DEFAULT NULL, recipe_id INT NOT NULL, quantity DOUBLE PRECISION NOT NULL, optional BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FF7A1370933FE08C ON recipe_has_ingredient (ingredient_id)');
        $this->addSql('CREATE INDEX IDX_FF7A1370F8BD700D ON recipe_has_ingredient (unit_id)');
        $this->addSql('CREATE INDEX IDX_FF7A13708C5289C9 ON recipe_has_ingredient (ingredient_group_id)');
        $this->addSql('CREATE INDEX IDX_FF7A137059D8A214 ON recipe_has_ingredient (recipe_id)');
        $this->addSql('CREATE TABLE source (id INT NOT NULL, url VARCHAR(255) DEFAULT NULL, name VARCHAR(128) NOT NULL, slug VARCHAR(128) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5F8A7F73989D9B62 ON source (slug)');
        $this->addSql('CREATE TABLE source_recipe (source_id INT NOT NULL, recipe_id INT NOT NULL, PRIMARY KEY(source_id, recipe_id))');
        $this->addSql('CREATE INDEX IDX_6C7794D1953C1C61 ON source_recipe (source_id)');
        $this->addSql('CREATE INDEX IDX_6C7794D159D8A214 ON source_recipe (recipe_id)');
        $this->addSql('CREATE TABLE step (id INT NOT NULL, recipe_id INT NOT NULL, content TEXT NOT NULL, priority SMALLINT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_43B9FE3C59D8A214 ON step (recipe_id)');
        $this->addSql('CREATE TABLE tag (id INT NOT NULL, menu BOOLEAN NOT NULL, name VARCHAR(128) NOT NULL, slug VARCHAR(128) NOT NULL, description TEXT DEFAULT NULL, priority SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_389B783989D9B62 ON tag (slug)');
        $this->addSql('CREATE TABLE tag_recipe (tag_id INT NOT NULL, recipe_id INT NOT NULL, PRIMARY KEY(tag_id, recipe_id))');
        $this->addSql('CREATE INDEX IDX_33C9F81BBAD26311 ON tag_recipe (tag_id)');
        $this->addSql('CREATE INDEX IDX_33C9F81B59D8A214 ON tag_recipe (recipe_id)');
        $this->addSql('CREATE TABLE unit (id INT NOT NULL, singular VARCHAR(255) NOT NULL, plural VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F73B21E9C FOREIGN KEY (step_id) REFERENCES step (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_has_ingredient ADD CONSTRAINT FK_FF7A1370933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_has_ingredient ADD CONSTRAINT FK_FF7A1370F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_has_ingredient ADD CONSTRAINT FK_FF7A13708C5289C9 FOREIGN KEY (ingredient_group_id) REFERENCES ingredient_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_has_ingredient ADD CONSTRAINT FK_FF7A137059D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE source_recipe ADD CONSTRAINT FK_6C7794D1953C1C61 FOREIGN KEY (source_id) REFERENCES source (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE source_recipe ADD CONSTRAINT FK_6C7794D159D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE step ADD CONSTRAINT FK_43B9FE3C59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tag_recipe ADD CONSTRAINT FK_33C9F81BBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tag_recipe ADD CONSTRAINT FK_33C9F81B59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE image_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ingredient_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ingredient_group_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE recipe_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE recipe_has_ingredient_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE source_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE step_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tag_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE unit_id_seq CASCADE');
        $this->addSql('ALTER TABLE image DROP CONSTRAINT FK_C53D045F73B21E9C');
        $this->addSql('ALTER TABLE image DROP CONSTRAINT FK_C53D045F59D8A214');
        $this->addSql('ALTER TABLE recipe_has_ingredient DROP CONSTRAINT FK_FF7A1370933FE08C');
        $this->addSql('ALTER TABLE recipe_has_ingredient DROP CONSTRAINT FK_FF7A1370F8BD700D');
        $this->addSql('ALTER TABLE recipe_has_ingredient DROP CONSTRAINT FK_FF7A13708C5289C9');
        $this->addSql('ALTER TABLE recipe_has_ingredient DROP CONSTRAINT FK_FF7A137059D8A214');
        $this->addSql('ALTER TABLE source_recipe DROP CONSTRAINT FK_6C7794D1953C1C61');
        $this->addSql('ALTER TABLE source_recipe DROP CONSTRAINT FK_6C7794D159D8A214');
        $this->addSql('ALTER TABLE step DROP CONSTRAINT FK_43B9FE3C59D8A214');
        $this->addSql('ALTER TABLE tag_recipe DROP CONSTRAINT FK_33C9F81BBAD26311');
        $this->addSql('ALTER TABLE tag_recipe DROP CONSTRAINT FK_33C9F81B59D8A214');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE ingredient_group');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('DROP TABLE recipe_has_ingredient');
        $this->addSql('DROP TABLE source');
        $this->addSql('DROP TABLE source_recipe');
        $this->addSql('DROP TABLE step');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_recipe');
        $this->addSql('DROP TABLE unit');
    }
}
