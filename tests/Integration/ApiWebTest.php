<?php

namespace Integration;

use App\Kernel;
use PHPUnit\Framework\Attributes\After;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiWebTest extends WebTestCase
{
    protected static function createKernel(array $options = []): Kernel
    {
        return new Kernel('test', false);
    }

    #[After]
    public function __internalDisableErrorHandler(): void
    {
        restore_exception_handler();
    }

    public function testHome(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $decoded = json_decode($client->getResponse()->getContent(), true);
        $this->assertSame("It's full of stars!", $decoded);
    }

    public function testVersions(): void
    {
        $client = static::createClient();
        $client->request('GET', '/versions');

        $this->assertResponseIsSuccessful();
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertIsArray($json);
        $this->assertArrayHasKey('stable', $json);
        $this->assertArrayHasKey('development', $json);
        $this->assertArrayHasKey('nightly', $json);
    }

    public function testVersionStable(): void
    {
        $client = static::createClient();
        $client->request('GET', '/version/stable');

        $this->assertResponseIsSuccessful();
        $value = json_decode($client->getResponse()->getContent(), true);
        $this->assertIsString($value);
    }

    public function testVerifySuccess(): void
    {
        $client = static::createClient();
        $client->request('GET', '/verify/2.8.18');

        $this->assertResponseIsSuccessful();
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertIsArray($json);
        $this->assertArrayHasKey('created', $json);
    }

    public function testVerifyInvalid(): void
    {
        $client = static::createClient();
        $client->request('GET', '/verify/not-a-version');

        $this->assertSame(418, $client->getResponse()->getStatusCode());
    }
}
