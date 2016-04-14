<?php

namespace AppBundle\Service;

class NumericValueProvider implements ValueProviderInterface
{
    /**
     * @var array
     */
    protected $values;

    /**
     * @var int
     */
    protected $currentIndex;

    /**
     * NumericValueProvider constructor.
     */
    public function __construct()
    {
        $this->values = array();
        $this->currentIndex = 0;
        $this->fillValues();
    }

    /**
     * returns a value from the stack
     */
    public function getValue()
    {
        $this->currentIndex++;

        return $this->values[$this->currentIndex];
    }

    /**
     * fills the stack with values
     */
    protected function fillValues()
    {
        for ($i = 1; $i <= 100; $i++) {
            $this->values[] = $i;
        }
    }
}