<?php

namespace App\Tests\Repository;

use App\Repository\UserRepository;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    /**
     * @var AbstractDatabaseTool $databaseTool
     */
    protected $databaseTool;

    public function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
        $this->databaseTool = self::$container->get(DatabaseToolCollection::class)->get();
    }

    public function testCount()
    {
        $this->databaseTool->loadAliceFixture([
                __DIR__.'/UserRepositoryTestFixtures.yml'
            ]);

        $users = self::$container->get(UserRepository::class)->count([]);

        $this->assertEquals(10, $users);
    }
}
