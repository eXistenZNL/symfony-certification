<?php

namespace AppBundle\Service;

interface DiceInterface {
    /**
     * Roll the dice, retuning a value
     *
     * @return mixed
     */
    public function roll();
}