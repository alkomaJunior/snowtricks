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
                        (1, 1, 1, 'Le nose grab', 'C’est le grab des débutants. Au moment ou le skate décolle du sol, il suffit d’attraper le nose avec la main avant (la gauche pour un regular, la droite pour un goofy). La figure est réussie lorsque la préhension est correcte et que les pieds restent bien en contact avec la planche (le pied arrière à la fâcheuse tendance à se décoller franchement). Facile à apprendre, cette figure laissera néanmoins de vilains souvenirs aux doigts lorsque la board viendra claquer sur les doigts plutôt que de venir se positionner au milieu de la pince formée par le pouce et les autres doigts. Cette figure est plus pratique lorsque la main est plutôt sur le côté des talons (ça permet de mieux faire coller le skate aux pieds en appuyant avec ses doigts).', 'lenosegrab', '2021-11-22 11:01:30', '2021-11-22 11:01:30'),
                        (2, 1, 1, 'Le indy', 'Le indy (front grab) est le grab de sécurité par excellence. La main arrière (la droite pour les regular, la gauche pour les goofy), attrape le milieu de la board entre les pointes de pied. Cette figure est bien plus réussie lorsque la main est proche du pied arrière (voire le touche). Cela permet de tendre le pied avant et de réaliser un nosebone. La plupart des débutants font hélas des indy crapauds avec la main avant en plein milieu ou proche du pied avant et les jambes accroupies. C’est un grab très confortable ou la planche est fermement maintenu et qui est facile. Il permet de bien voir ce qui se passe pendant la période ou le skateur est en l’air. Incontournable et rassurant.', 'leindy', '2021-11-22 11:01:31', '2021-11-22 11:01:31'),
                        (3, 1, 1, 'Le sad', 'Ici, le skateur va attraper avec sa main avant (gauche pour un regular, droite pour un goofy) sa planche entre ses talons. Naturellement, la main va venir se positionner proche du pied avant (à cause de la contorsion nécessaire) et en poussant un peu sur le pied avant, on arrive à faire un joli grab tendu. Pratique mais moins facile que le indy, ce grab est sécurisant et permet de bien voir ce qui se passe une fois en l’air.', 'lesad', '2021-11-22 11:01:31', '2021-11-22 11:01:31'),
                        (4, 1, 1, 'Le mute', 'Pauvre mute : il a les inconvénients du indy sans en avoir les avantages. Le skateur attrape sa board entre ses doigts de pieds avec sa main avant (la gauche pour un goofy, la droite pour un regular). C’est un grab très facile mais qui induit un effet crapaud : tout accroupi, les genoux ouverts et la main avant proche du pied avant. Cette figure est réussie lorsque le genou avant est rentré (la main avant passe à l’extérieur (à l’avant)) ou lorsque la jambe avant est tendue.', 'lemute', '2021-11-22 11:01:31', '2021-11-22 11:01:31'),
                        (5, 1, 1, 'Le tail grab', 'Ce grab fait partie des basiques mais est difficile à exécuter correctement. Lors d’un ollie, la main arrière (la droite pour un regular, la gauche pour un goofy) vient attraper le tail. Comme le mouvement est peu évident, le tail sera uniquement effleuré lors des premiers essais. Au fil du temps et avec de l’amplitude, le tail pourra être correctement grabbé. Plus facile lorsque la jambe avant est tendue et la jambe arrière bien repliée.', 'letailgrab', '2021-11-22 11:01:31', '2021-11-22 11:01:31'),
                        (6, 2, 1, 'Les flips', 'Un flip est une rotation verticale. On distingue les front flips, rotations en avant, et les back flips, rotations en arrière. Il est possible de faire plusieurs flips à la suite, et d\'ajouter un grab à la rotation. Les flips agrémentés d\'une vrille existent aussi (Mac Twist, Hakon Flip...), mais de manière beaucoup plus rare, et se confondent souvent avec certaines rotations horizontales désaxées. Néanmoins, en dépit de la difficulté technique relative d\'une telle figure, le danger de retomber sur la tête ou la nuque est réel et conduit certaines stations de ski à interdire de telles figures dans ses snowparks.', 'lesflips', '2021-11-22 11:01:31', '2021-11-22 11:01:31'),
                        (7, 2, 1, 'Les rotations désaxées', 'Une rotation désaxée est une rotation initialement horizontale mais lancée avec un mouvement des épaules particulier qui désaxe la rotation. Il existe différents types de rotations désaxées (corkscrew ou cork, rodeo, misty, etc.) en fonction de la manière dont est lancé le buste. Certaines de ces rotations, bien qu\'initialement horizontales, font passer la tête en bas. Bien que certaines de ces rotations soient plus faciles à faire sur un certain nombre de tours (ou de demi-tours) que d\'autres, il est en théorie possible de d\'attérir n\'importe quelle rotation désaxée avec n\'importe quel nombre de tours, en jouant sur la quantité de désaxage afin de se retrouver à la position verticale au moment voulu. Il est également possible d\'agrémenter une rotation désaxée par un grab.', 'lesrotationsdésaxées', '2021-11-22 11:01:31', '2021-11-22 11:01:31'),
                        (8, 2, 1, 'Les slides', 'Un slide consiste à glisser sur une barre de slide. Le slide se fait soit avec la planche dans l\'axe de la barre, soit perpendiculaire, soit plus ou moins désaxé. On peut slider avec la planche centrée par rapport à la barre (celle-ci se situe approximativement au-dessous des pieds du rideur), mais aussi en nose slide, c\'est-à-dire l\'avant de la planche sur la barre, ou en tail slide, l\'arrière de la planche sur la barre.', 'lesslides', '2021-11-22 11:01:31', '2021-11-22 11:01:31'),
                        (9, 2, 1, 'Les one foot tricks', 'Figures réalisée avec un pied décroché de la fixation, afin de tendre la jambe correspondante pour mettre en évidence le fait que le pied n\'est pas fixé. Ce type de figure est extrêmement dangereuse pour les ligaments du genou en cas de mauvaise réception.', 'lesonefoottricks', '2021-11-22 11:01:31', '2021-11-22 11:01:31'),
                        (10, 2, 1, 'Le backside air', 'Avec le backside air, les skateurs apprennent à sauter plus haut que le coping pour replonger dans la rampe. Les airs forment la base du skateboard dans la rampe verticale d’où découlent de nombreuses autres figures. Commencer d’abord par des ollies simples en dessous du coping. Augmenter peu à peu la hauteur pour dépasser le coping. En l’air, il est important de bien presser la planche sous les pieds afin de ne pas la perdre. Pour assurer une réception propre, le skateur tourne l’épaule avant en direction de la pente.', 'Lebacksideair', '2021-11-22 11:01:31', '2021-11-22 11:01:31')");
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
