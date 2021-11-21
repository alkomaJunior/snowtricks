<?php

namespace App\Tests\Entity;

use App\Entity\Media;
use App\Entity\Trick;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MediaEntityTest extends KernelTestCase
{
    public function getEntity(): Media
    {
        return (new Media())
            ->setIsFrontPageMedia(true)
            ->setMediaType("Image")
            ->setTrick((new Trick()))
            ->setSlug("myFile.png")
            ->setMediaFileName("my_file.png");
    }

    public function assertHasErrors(Media $media, int $number = 0)
    {
        self::bootKernel();
        $error = self::$container->get('validator')->validate($media);
        $this->assertCount($number, $error);
    }

    public function testValidMediaEntity()
    {
        $this->assertHasErrors($this->getEntity(), 0);
    }

    public function testInvalidMediaEntity()
    {
        $this->assertHasErrors($this->getEntity()->setSlug(""), 0);
    }
}
