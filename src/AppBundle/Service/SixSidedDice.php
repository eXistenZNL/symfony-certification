<?php

namespace AppBundle\Service;

class SixSidedDice implements DiceInterface, ValueProviderAwareInterface
{
    /**
     * @var array
     */
    protected $values;

    /**
     * SixSidedDice constructor.
     */
    public function __construct()
    {
        $this->values = array();
    }

    /**
     * Roll the dice, retuning a value
     *
     * @return mixed
     */
    public function roll()
    {
        return array_rand($this->values);
    }

    /**
     * @param ValueProviderInterface $valueProvider
     */
    public function calculateValues(ValueProviderInterface $valueProvider)
    {
        for ($i = 0; $i <= 6; $i++) {
            $this->values[] = $valueProvider->getValue();
        }
    }
}
