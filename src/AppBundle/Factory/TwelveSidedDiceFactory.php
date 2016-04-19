<?php

namespace AppBundle\Factory;

use AppBundle\Service\TwelveSidedDice;
use AppBundle\Service\ValueProviderInterface;

class TwelveSidedDiceFactory
{
    /**
     * @var ValueProviderInterface
     */
    protected $valueProvider;

    public function __construct(ValueProviderInterface $valueProvider)
    {
        $this->valueProvider = $valueProvider;
    }

    /**
     * Produce a new instance of the TwelveSidedDice
     *
     * @return TwelveSidedDice
     */
    public function createTwelveSidedDice()
    {
        // get 12 values form the provider
        $values = [];
        for ($i = 0; $i < 12; $i++) {
            $values[] = $this->valueProvider->getValue();
        }

        return new TwelveSidedDice($values);
    }
}