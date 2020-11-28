<?php

declare(strict_types=1);

namespace App\Symfony\DependencyInjection\Compiler;

use App\Infrastructure\Provider\ServicesProviderInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ClientWeatherPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$container->has(ServicesProviderInterface::class)) {
            return;
        }

        $definition = $container->findDefinition(ServicesProviderInterface::class);

        $taggedServices = $container->findTaggedServiceIds('api.client_weather');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addService', [new Reference($id)]);
        }
    }
}