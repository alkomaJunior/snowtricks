<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Contracts\Translation\TranslatorInterface;

class SecurityControllerTest extends WebTestCase
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

    public function testUnsuccessfulLogin()
    {
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton("".self::$container->get(TranslatorInterface::class)->trans('Sign in'))->form([
            'email' => 'john@some.where',
            'password' => 'fakePassword'
        ]);
        $this->client->submit($form);
        $this->assertResponseRedirects('/login');
        $this->client->followRedirect();
        $this->assertSelectorExists('.alert.alert-danger.text-center');
    }

    public function testSuccessfulLogin()
    {
        $this->databaseTool->loadAliceFixture([
            __DIR__.'/users.yaml'
        ]);
        $csrfToken = $this->client->getContainer()->get('security.csrf.token_manager')->getToken('authenticate');
        $this->client->request('POST', '/login', [
            '_csrf_token' => $csrfToken,
            'email' => 'john@some.where',
            'password' => 'fakePassword'
        ]);
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }

    public function testRoles()
    {
        $users = $this->databaseTool->loadAliceFixture([
            __DIR__.'/users.yaml'
        ]);
        /** @var User $user */
        $user = $users['user_user'];

        $session = $this->client->getContainer()->get('session');
        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
        $session->set('_security_main', serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);

        $this->client->request('GET', '/my-tricks');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
