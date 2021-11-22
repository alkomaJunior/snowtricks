<?php

namespace App\Tests\Controller;

use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GroupControllerTest extends WebTestCase
{
    /**
     * @var AbstractDatabaseTool $databaseTool
     */
    protected $databaseTool;
    protected $client;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $this->databaseTool = self::$container->get(DatabaseToolCollection::class)->get();
    }

    public function testAddGroup()
    {
        $this->client->request('POST', '/group/new', [
            'title' => 'Group 3'
        ]);
        $this->assertResponseRedirects();
    }
}
