<?php

namespace AppBundle\DependencyInjection;

use AppBundle\Controller\DiceController;
use AppBundle\Service\SixEyedDice;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Gigya Bundle Configuration loading
 */
class AppExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        // only load default services and parameters once  disabled because it did not work for me
//        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
//        $loader->load('services.xml');

        $sixDiceDefinition = new Definition(SixEyedDice::class);
        $container->setDefinition('app.dice.six', $sixDiceDefinition);

        $diceControllerDefinition = new Definition(DiceController::class);
        $diceControllerDefinition->setArguments(array(new Reference('app.dice.six')));
        $diceControllerDefinition->addMethodCall('setContainer', array(new Reference('service_container')));
        $container->setDefinition('app.dice_controller', $diceControllerDefinition);
    }
}