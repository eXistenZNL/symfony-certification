<?php

namespace AppBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class InsertValueProviderPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $taggedServices = $container->findTaggedServiceIds(
            'app.dice.provider.aware'
        );

        foreach ($taggedServices as $id => $tags) {
            $service = $container->getDefinition($id);
            $service->addMethodCall('calculateValues', array(new Reference('app.dice.provider.numeric')));
        }
    }
}
