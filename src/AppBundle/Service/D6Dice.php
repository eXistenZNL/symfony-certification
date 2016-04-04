<?php

namespace AppBundle\Service;

use AppBundle\Contract\Dice;
use AppBundle\Exception\IllegalArgumentException;

class D6Dice implements Dice {

    /**
     * D6Dice constructor. Fills the dice with the 6 values
     * @param array $values
     * @throws IllegalArgumentException
     */
    public function __construct(array $values)
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
