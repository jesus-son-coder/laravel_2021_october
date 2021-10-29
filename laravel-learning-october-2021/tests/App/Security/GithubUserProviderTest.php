<?php
namespace Tests\App\Security;

use PHPUnit\Framework\TestCase;
use App\Security\GithubUserProvider;
use App\Models\User;
use Mockery;
use DG\BypassFinals as DGByPass;

class GithubUserProviderTest extends TestCase
{
    public function testLoadUserByUsernameReturningUser()
    {
        DGByPass::enable();

        $client = $this->getMockBuilder('GuzzleHttp\Client')
            ->disableOriginalConstructor()
            ->onlyMethods(['get'])
            ->getMock();

        $serializer = $this
            ->getMockBuilder('JMS\Serializer\Serializer')
            ->disableOriginalConstructor()
            ->getMock();

        $reponse = $this
            ->getMockBuilder('Psr\Http\Message\ResponseInterface')
            ->getMock();

        $client
            ->expects($this->once())
            ->method('get')
            ->willReturn($reponse);

        $streamedResponse = $this
            ->getMockBuilder('Psr\Http\Message\StreamInterface')
            ->getMock();

        $reponse
            ->expects($this->once())
            ->method('getBody')
            ->willReturn($streamedResponse);

       // $reponse->method('getContents')->willReturn('coucou');

        $userData = ['login' => 'a login', 'name' => 'user name', 'email' => 'adress@mail.com', 'avatar_url' => 'url to the avatar', 'html_url' => 'url to profile'];

        $serializer
            ->expects($this->once())
            ->method('deserialize')
            ->willReturn($userData);

        $githubUserProvider = new GithubUserProvider($client, $serializer);
        $user = $githubUserProvider->loadUserByUsername('an-access-token');

        $expectedUser = new User($userData['login'], $userData['name'], $userData['email'], $userData['avatar_url'], $userData['html_url']);

        $this->assertEquals($expectedUser, $user);
        $this->assertEquals('App\Models\User', get_class($user));

    }
}


