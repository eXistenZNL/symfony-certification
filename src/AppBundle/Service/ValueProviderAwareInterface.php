<?php

namespace AppBundle\Service;

interface ValueProviderAwareInterface
{
    public function calculateValues(ValueProviderInterface $valueProvider);
}