<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UsersFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i >10; $i++) {
            $user = (new User())
                ->setEmail("user$i@domain.fr")
                ->setPseudo("user$i")
                ->setPassword("####");
            $manager->persist($user);
        }
        $manager->flush();
    }
}
