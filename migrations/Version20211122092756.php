<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211122092756 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `comments` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, trick_id INT DEFAULT NULL, message LONGTEXT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_5F9E962AA76ED395 (user_id), INDEX IDX_5F9E962AB281BE2E (trick_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `groups` (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `medias` (id INT AUTO_INCREMENT NOT NULL, trick_id INT NOT NULL, media_file_name VARCHAR(255) DEFAULT NULL, media_url VARCHAR(255) DEFAULT NULL, media_type VARCHAR(255) NOT NULL, is_front_page_media TINYINT(1) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_12D2AF81B281BE2E (trick_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `tricks` (id INT AUTO_INCREMENT NOT NULL, trick_group_id INT DEFAULT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_E1D902C19B875DF8 (trick_group_id), INDEX IDX_E1D902C1A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `users` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, is_active TINYINT(1) NOT NULL, activation_token VARCHAR(255) DEFAULT NULL, reset_token VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `comments` ADD CONSTRAINT FK_5F9E962AA76ED395 FOREIGN KEY (user_id) REFERENCES `users` (id)');
        $this->addSql('ALTER TABLE `comments` ADD CONSTRAINT FK_5F9E962AB281BE2E FOREIGN KEY (trick_id) REFERENCES `tricks` (id)');
        $this->addSql('ALTER TABLE `medias` ADD CONSTRAINT FK_12D2AF81B281BE2E FOREIGN KEY (trick_id) REFERENCES `tricks` (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES `users` (id)');
        $this->addSql('ALTER TABLE `tricks` ADD CONSTRAINT FK_E1D902C19B875DF8 FOREIGN KEY (trick_group_id) REFERENCES `groups` (id)');
        $this->addSql('ALTER TABLE `tricks` ADD CONSTRAINT FK_E1D902C1A76ED395 FOREIGN KEY (user_id) REFERENCES `users` (id)');
        $this->addSql("INSERT INTO `users` (`id`, `email`, `roles`, `password`, `pseudo`, `avatar`, `is_active`, `activation_token`, `reset_token`, `created_at`, `updated_at`, `slug`) VALUES
                        (1, 'jimmysnowtricks@gmail.com', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '\$argon2id\$v=19\$m=65536,t=4,p=1\$IQgH+XVXKzYyhWECic/hvg\$tFizNjMLj4CV951KUcaKaIXE5XPyzTyR7Gq1oaz8a/A', 'jimmy', '', 1, NULL, NULL, '2021-11-22 10:38:53', '2021-11-22 10:22:06', 'jimmy')");
        $this->addSql("INSERT INTO `groups` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
                        (1, 'Grabs', 'grabs', '2021-11-22 10:41:19', '2021-11-22 10:41:19'),
                        (2, 'Rotations', 'rotations', '2021-11-22 10:41:19', '2021-11-22 10:41:19'),
                        (3, 'Sauts', 'sauts', '2021-11-22 11:03:22', '2021-11-22 11:03:22'),
                        (4, 'Barre de slide', 'barredeslide', '2021-11-22 11:03:22', '2021-11-22 11:03:22')");
        $this->addSql("INSERT INTO `tricks` (`id`, `trick_group_id`, `user_id`, `name`, `description`, `slug`, `created_at`, `updated_at`) VALUES
                        (1, 1, 1, 'Le nose grab', 'C???est le grab des d??butants. Au moment ou le skate d??colle du sol, il suffit d???attraper le nose avec la main avant (la gauche pour un regular, la droite pour un goofy). La figure est r??ussie lorsque la pr??hension est correcte et que les pieds restent bien en contact avec la planche (le pied arri??re ?? la f??cheuse tendance ?? se d??coller franchement). Facile ?? apprendre, cette figure laissera n??anmoins de vilains souvenirs aux doigts lorsque la board viendra claquer sur les doigts plut??t que de venir se positionner au milieu de la pince form??e par le pouce et les autres doigts. Cette figure est plus pratique lorsque la main est plut??t sur le c??t?? des talons (??a permet de mieux faire coller le skate aux pieds en appuyant avec ses doigts).', 'lenosegrab', '2021-11-22 11:01:30', '2021-11-22 11:01:30'),
                        (2, 1, 1, 'Le indy', 'Le indy (front grab) est le grab de s??curit?? par excellence. La main arri??re (la droite pour les regular, la gauche pour les goofy), attrape le milieu de la board entre les pointes de pied. Cette figure est bien plus r??ussie lorsque la main est proche du pied arri??re (voire le touche). Cela permet de tendre le pied avant et de r??aliser un nosebone. La plupart des d??butants font h??las des indy crapauds avec la main avant en plein milieu ou proche du pied avant et les jambes accroupies. C???est un grab tr??s confortable ou la planche est fermement maintenu et qui est facile. Il permet de bien voir ce qui se passe pendant la p??riode ou le skateur est en l???air. Incontournable et rassurant.', 'leindy', '2021-11-22 11:01:31', '2021-11-22 11:01:31'),
                        (3, 1, 1, 'Le sad', 'Ici, le skateur va attraper avec sa main avant (gauche pour un regular, droite pour un goofy) sa planche entre ses talons. Naturellement, la main va venir se positionner proche du pied avant (?? cause de la contorsion n??cessaire) et en poussant un peu sur le pied avant, on arrive ?? faire un joli grab tendu. Pratique mais moins facile que le indy, ce grab est s??curisant et permet de bien voir ce qui se passe une fois en l???air.', 'lesad', '2021-11-22 11:01:31', '2021-11-22 11:01:31'),
                        (4, 1, 1, 'Le mute', 'Pauvre mute : il a les inconv??nients du indy sans en avoir les avantages. Le skateur attrape sa board entre ses doigts de pieds avec sa main avant (la gauche pour un goofy, la droite pour un regular). C???est un grab tr??s facile mais qui induit un effet crapaud : tout accroupi, les genoux ouverts et la main avant proche du pied avant. Cette figure est r??ussie lorsque le genou avant est rentr?? (la main avant passe ?? l???ext??rieur (?? l???avant)) ou lorsque la jambe avant est tendue.', 'lemute', '2021-11-22 11:01:31', '2021-11-22 11:01:31'),
                        (5, 1, 1, 'Le tail grab', 'Ce grab fait partie des basiques mais est difficile ?? ex??cuter correctement. Lors d???un ollie, la main arri??re (la droite pour un regular, la gauche pour un goofy) vient attraper le tail. Comme le mouvement est peu ??vident, le tail sera uniquement effleur?? lors des premiers essais. Au fil du temps et avec de l???amplitude, le tail pourra ??tre correctement grabb??. Plus facile lorsque la jambe avant est tendue et la jambe arri??re bien repli??e.', 'letailgrab', '2021-11-22 11:01:31', '2021-11-22 11:01:31'),
                        (6, 2, 1, 'Les flips', 'Un flip est une rotation verticale. On distingue les front flips, rotations en avant, et les back flips, rotations en arri??re. Il est possible de faire plusieurs flips ?? la suite, et d\'ajouter un grab ?? la rotation. Les flips agr??ment??s d\'une vrille existent aussi (Mac Twist, Hakon Flip...), mais de mani??re beaucoup plus rare, et se confondent souvent avec certaines rotations horizontales d??sax??es. N??anmoins, en d??pit de la difficult?? technique relative d\'une telle figure, le danger de retomber sur la t??te ou la nuque est r??el et conduit certaines stations de ski ?? interdire de telles figures dans ses snowparks.', 'lesflips', '2021-11-22 11:01:31', '2021-11-22 11:01:31'),
                        (7, 2, 1, 'Les rotations d??sax??es', 'Une rotation d??sax??e est une rotation initialement horizontale mais lanc??e avec un mouvement des ??paules particulier qui d??saxe la rotation. Il existe diff??rents types de rotations d??sax??es (corkscrew ou cork, rodeo, misty, etc.) en fonction de la mani??re dont est lanc?? le buste. Certaines de ces rotations, bien qu\'initialement horizontales, font passer la t??te en bas. Bien que certaines de ces rotations soient plus faciles ?? faire sur un certain nombre de tours (ou de demi-tours) que d\'autres, il est en th??orie possible de d\'att??rir n\'importe quelle rotation d??sax??e avec n\'importe quel nombre de tours, en jouant sur la quantit?? de d??saxage afin de se retrouver ?? la position verticale au moment voulu. Il est ??galement possible d\'agr??menter une rotation d??sax??e par un grab.', 'lesrotationsd??sax??es', '2021-11-22 11:01:31', '2021-11-22 11:01:31'),
                        (8, 2, 1, 'Les slides', 'Un slide consiste ?? glisser sur une barre de slide. Le slide se fait soit avec la planche dans l\'axe de la barre, soit perpendiculaire, soit plus ou moins d??sax??. On peut slider avec la planche centr??e par rapport ?? la barre (celle-ci se situe approximativement au-dessous des pieds du rideur), mais aussi en nose slide, c\'est-??-dire l\'avant de la planche sur la barre, ou en tail slide, l\'arri??re de la planche sur la barre.', 'lesslides', '2021-11-22 11:01:31', '2021-11-22 11:01:31'),
                        (9, 2, 1, 'Les one foot tricks', 'Figures r??alis??e avec un pied d??croch?? de la fixation, afin de tendre la jambe correspondante pour mettre en ??vidence le fait que le pied n\'est pas fix??. Ce type de figure est extr??mement dangereuse pour les ligaments du genou en cas de mauvaise r??ception.', 'lesonefoottricks', '2021-11-22 11:01:31', '2021-11-22 11:01:31'),
                        (10, 2, 1, 'Le backside air', 'Avec le backside air, les skateurs apprennent ?? sauter plus haut que le coping pour replonger dans la rampe. Les airs forment la base du skateboard dans la rampe verticale d???o?? d??coulent de nombreuses autres figures. Commencer d???abord par des ollies simples en dessous du coping. Augmenter peu ?? peu la hauteur pour d??passer le coping. En l???air, il est important de bien presser la planche sous les pieds afin de ne pas la perdre. Pour assurer une r??ception propre, le skateur tourne l?????paule avant en direction de la pente.', 'Lebacksideair', '2021-11-22 11:01:31', '2021-11-22 11:01:31')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `tricks` DROP FOREIGN KEY FK_E1D902C19B875DF8');
        $this->addSql('ALTER TABLE `comments` DROP FOREIGN KEY FK_5F9E962AB281BE2E');
        $this->addSql('ALTER TABLE `medias` DROP FOREIGN KEY FK_12D2AF81B281BE2E');
        $this->addSql('ALTER TABLE `comments` DROP FOREIGN KEY FK_5F9E962AA76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE `tricks` DROP FOREIGN KEY FK_E1D902C1A76ED395');
        $this->addSql('DROP TABLE `comments`');
        $this->addSql('DROP TABLE `groups`');
        $this->addSql('DROP TABLE `medias`');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE `tricks`');
        $this->addSql('DROP TABLE `users`');
    }
}
