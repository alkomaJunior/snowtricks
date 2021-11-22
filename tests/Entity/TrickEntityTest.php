<?php

namespace App\Tests\Entity;

use App\Entity\Group;
use App\Entity\Trick;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TrickEntityTest extends KernelTestCase
{
    public function getEntity(): Trick
    {
        return (new Trick())
            ->setName("Trick 1")
            ->setDescription("Trick 1 description")
            ->setTrickGroup((new Group()))
            ->setSlug("trick1");
    }

    public function assertHasErrors(Trick $trick, int $number = 0)
    {
        self::bootKernel();
        $error = self::$container->get('validator')->validate($trick);
        $this->assertCount($number, $error);
    }

    public function testValidTrickEntity()
    {
        $this->assertHasErrors($this->getEntity(), 0);
    }

    public function testInvalidTrickEntity()
    {
        $this->assertHasErrors($this->getEntity()->setSlug(""), 0);
    }
}
