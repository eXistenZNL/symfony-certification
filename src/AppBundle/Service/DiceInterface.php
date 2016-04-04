<?php

namespace AppBundle\Service;

interface DiceInterface {

    /**
     * Dice constructor which sets all the values of the sides in the dice
     * 
     * @param array $values
     */
    public function __construct(array $values);

    /**
     * Roll the dice, retuning a value
     *
     * @return mixed
     */
    public function roll();
}