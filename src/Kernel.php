<?php

namespace App;

use App\Controller\ApiController;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function dirname;

require_once __DIR__ . '/../phpmyfaq.php';

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function registerBundles(): iterable
    {
        return [new FrameworkBundle()];
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $isTest = $this->getEnvironment() === 'test';

        $container->extension('framework', [
            'secret' => 'test-secret',
            'http_method_override' => false,
            'test' => $isTest,
            'session' => [
                'enabled' => false,
            ],
            'router' => [
                'utf8' => true,
            ],
        ]);
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->add('home', '/')->controller([ApiController::class, 'home'])->methods(['GET']);
        $routes->add('versions', '/versions')->controller([ApiController::class, 'versions'])->methods(['GET']);
        $routes->add('version_stable', '/version/stable')->controller([ApiController::class, 'versionStable'])->methods(['GET']);
        $routes->add('version_development', '/version/development')->controller([ApiController::class, 'versionDevelopment'])->methods(['GET']);
        $routes->add('version_nightly', '/version/nightly')->controller([ApiController::class, 'versionNightly'])->methods(['GET']);
        $routes->add('verify', '/verify/{version}')
            ->controller([ApiController::class, 'verify'])
            ->methods(['GET'])
            ->requirements(['version' => '.+']);
    }

    public function getProjectDir(): string
    {
        return dirname(__DIR__);
    }
}
