<?php

namespace AppBundle\Service;

use AppBundle\Exception\IllegalArgumentException;

class SixEyedDice implements DiceInterface {

    /**
     * D6Dice constructor. Fills the dice with the 6 values
     * @param array $values
     * @throws IllegalArgumentException
     */
    public function __construct(array $values = array(1,2,3,4,5,6))
    {
        if(count($values) != 6) {
            throw new IllegalArgumentException('A 6 sided dice must contain all 6 values');
        }
    }

    /**
     * Roll the dice, retuning a value
     *
     * @return mixed
     */
    public function roll()
    {
        // TODO: Implement roll() method.
    }
}
