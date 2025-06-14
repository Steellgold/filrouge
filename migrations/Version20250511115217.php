<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250511115217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE address (id VARCHAR(36) NOT NULL, user_id VARCHAR(36) NOT NULL, street VARCHAR(255) NOT NULL, postal_code VARCHAR(10) NOT NULL, city VARCHAR(255) NOT NULL, complement VARCHAR(255) DEFAULT NULL, is_primary TINYINT(1) NOT NULL, label VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_D4E6F81A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE bakery (id VARCHAR(36) NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, story LONGTEXT DEFAULT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(10) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, rating DOUBLE PRECISION DEFAULT NULL, images JSON DEFAULT NULL, opening_hours JSON DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', UNIQUE INDEX UNIQ_C647FA2A989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE cart (id VARCHAR(36) NOT NULL, user_id VARCHAR(36) DEFAULT NULL, session_id VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_BA388B7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE cart_item (id VARCHAR(36) NOT NULL, cart_id VARCHAR(36) NOT NULL, product_id VARCHAR(36) NOT NULL, quantity INT NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_F0FE25271AD5CDBF (cart_id), INDEX IDX_F0FE25274584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE category (id VARCHAR(36) NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, position INT DEFAULT 0 NOT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', UNIQUE INDEX UNIQ_64C19C1989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE `order` (id VARCHAR(36) NOT NULL, user_id VARCHAR(36) NOT NULL, reference VARCHAR(255) NOT NULL, total_amount DOUBLE PRECISION NOT NULL, status VARCHAR(50) NOT NULL, stripe_session_id VARCHAR(255) DEFAULT NULL, stripe_payment_intent_id VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', shipping_address JSON DEFAULT NULL, billing_address JSON DEFAULT NULL, token VARCHAR(64) DEFAULT NULL, INDEX IDX_F5299398A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE order_item (id VARCHAR(36) NOT NULL, order_id VARCHAR(36) NOT NULL, product_id VARCHAR(36) NOT NULL, quantity INT NOT NULL, price DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_52EA1F098D9F6D38 (order_id), INDEX IDX_52EA1F094584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE `user` (id VARCHAR(36) NOT NULL, managed_bakery_id VARCHAR(36) DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, phone VARCHAR(15) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', is_verified TINYINT(1) DEFAULT NULL, reset_token VARCHAR(100) DEFAULT NULL, reset_token_expires_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D64959181A75 (managed_bakery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE user_favorite_bakeries (user_id VARCHAR(36) NOT NULL, bakery_id VARCHAR(36) NOT NULL, INDEX IDX_EC32BC5CA76ED395 (user_id), INDEX IDX_EC32BC5C5570DBC4 (bakery_id), PRIMARY KEY(user_id, bakery_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE address ADD CONSTRAINT FK_D4E6F81A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart ADD CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart_item ADD CONSTRAINT FK_F0FE25271AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart_item ADD CONSTRAINT FK_F0FE25274584665A FOREIGN KEY (product_id) REFERENCES product (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F098D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F094584665A FOREIGN KEY (product_id) REFERENCES product (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `user` ADD CONSTRAINT FK_8D93D64959181A75 FOREIGN KEY (managed_bakery_id) REFERENCES bakery (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_favorite_bakeries ADD CONSTRAINT FK_EC32BC5CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_favorite_bakeries ADD CONSTRAINT FK_EC32BC5C5570DBC4 FOREIGN KEY (bakery_id) REFERENCES bakery (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product ADD bakery_id VARCHAR(36) DEFAULT NULL, ADD category_id VARCHAR(36) DEFAULT NULL, ADD popularity INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product ADD CONSTRAINT FK_D34A04AD5570DBC4 FOREIGN KEY (bakery_id) REFERENCES bakery (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_D34A04AD5570DBC4 ON product (bakery_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD5570DBC4
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart_item DROP FOREIGN KEY FK_F0FE25271AD5CDBF
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart_item DROP FOREIGN KEY FK_F0FE25274584665A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F098D9F6D38
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F094584665A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64959181A75
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_favorite_bakeries DROP FOREIGN KEY FK_EC32BC5CA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_favorite_bakeries DROP FOREIGN KEY FK_EC32BC5C5570DBC4
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE address
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE bakery
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE cart
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE cart_item
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE category
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE `order`
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE order_item
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE `user`
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user_favorite_bakeries
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_D34A04AD5570DBC4 ON product
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_D34A04AD12469DE2 ON product
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product DROP bakery_id, DROP category_id, DROP popularity
        SQL);
    }
}
