<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use App\Symfony\DependencyInjection\Compiler\ClientWeatherPass;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function getProjectDir(): string
    {
        return \dirname(__DIR__) . '/';
    }

    protected function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new ClientWeatherPass());
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {

        $confDir = $this->getProjectDir().'/config';

        $container->import($confDir . '/{packages}/*.yaml');
        $container->import($confDir . '/{packages}/'.$this->environment.'/*.yaml');

        if (is_file($confDir . '/services.yaml')) {
            $container->import($confDir . '/services.yaml');
            $container->import($confDir . '/{services}_'.$this->environment.'.yaml');
        } elseif (is_file($path = $confDir . '/services.php')) {
            (require $path)($container->withPath($path), $this);
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $confDir = $this->getProjectDir().'/config';

        $routes->import($confDir . '/{routes}/'.$this->environment.'/*.yaml');
        $routes->import($confDir . '/{routes}/*.yaml');

        if (is_file($confDir . '/routes.yaml')) {
            $routes->import($confDir . '/routes.yaml');
        } elseif (is_file($path = $confDir . '/routes.php')) {
            (require $path)($routes->withPath($path), $this);
        }
    }
}
