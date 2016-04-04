<?php

namespace AppBundle\Service;

use AppBundle\Exception\IllegalArgumentException;

class TwelveSidedDice implements DiceInterface
{

    /**
     * @var array
     */
    protected $values;

    /**
     * D6Dice constructor, fills the dice with the 6 values
     *
     * @param array $values
     *
     * @throws IllegalArgumentException
     */
    public function __construct(array $values = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12))
    {
        if (count($values) != 12) {
            throw new IllegalArgumentException('A Regular dodecahedron dice must contain 12 values');
        }

        $this->values = $values;
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
}
