<?php

namespace AppBundle\Controller;

use AppBundle\Contract\Dice;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DiceController extends Controller
{
    /**
     * @var Dice
     */
    protected $dice;

    public function __construct(Dice $dice)
    {
        $this->dice = $dice;
    }

    /**
     * @Route("/oddOrEven", name="homepage")
     */
    public function indexAction(Request $request)
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
