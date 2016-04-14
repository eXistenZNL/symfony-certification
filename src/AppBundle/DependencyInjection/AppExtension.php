<?php

namespace AppBundle\DependencyInjection;

use AppBundle\Controller\DiceController;
use AppBundle\Service\NumericValueProvider;
use AppBundle\Service\SixSidedDice;
use AppBundle\Service\TwelveSidedDice;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
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
        // Load the configuration using a random syntax
        $strategies = array('xml', 'php', 'yml');
        $strategyKey = rand(0, count($strategies));
        switch ($strategies[$strategyKey]) {
            case "xml":
                $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
                $loader->load('services.xml');
                break;
            case "php":
                $numericValueProvider = new Definition(NumericValueProvider::class);
                $container->setDefinition('app.dice.provider.numeric', $numericValueProvider);

                $sixDiceDefinition = new Definition(SixSidedDice::class);
                $sixDiceDefinition->addTag('app.dice.provider.aware');
                $container->setDefinition('app.dice.six', $sixDiceDefinition);

                $twelveDiceDefinition = new Definition(TwelveSidedDice::class);
                $twelveDiceDefinition->addTag('app.rollable');
                $container->setDefinition('app.dice.twelve', $sixDiceDefinition);

                $diceControllerDefinition = new Definition(DiceController::class);
                $diceControllerDefinition->setArguments(array(new Reference('app.dice.six')));
                $diceControllerDefinition->addMethodCall('setContainer', array(new Reference('service_container')));
                $container->setDefinition('app.dice_controller', $diceControllerDefinition);
                break;
            case "yml":
                $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
                $loader->load('services.yml');
                break;
        }

        // Insert our NumericValueProvider to the services that are ValueProviderAware
        $this->insertNumericValueProvider($container);
    }

    protected function insertNumericValueProvider(ContainerBuilder $container)
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