<?php

namespace AppBundle\Controller;

use AppBundle\Service\DiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DiceController extends Controller
{
    /**
     * @var DiceInterface
     */
    protected $dice;

    public function __construct(DiceInterface $dice)
    {
        $this->dice = $dice;
    }

    /**
     * @Route("/oddOrEven", name="oddOrEven")
     */
    public function oddOrEvenAction(Request $request)
    {
        $number = $this->dice->roll();
        if(!is_int($number)){
            return 'Dice has no numbers';
        }

        if($number % 2 === 0) {
            return 'even';
        }

        return 'odd';
    }
}
