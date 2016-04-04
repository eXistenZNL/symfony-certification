<?php

namespace AppBundle\Controller;

use AppBundle\Service\D6Dice;
use AppBundle\Service\DiceInterface;
use AppBundle\Service\SixEyedDice;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DiceController extends Controller
{
    /**
     * @var DiceInterface
     */
    protected $dice;

    public function __construct(SixEyedDice $dice)
    {
        $this->dice = $dice;
    }

    /**
     * Shows "odd" or "even" to the user based on the injected dice service
     *
     * @param Request $request
     *
     * @return Response
     */
    public function oddOrEvenAction(Request $request)
    {
        $template = 'default/oneLine.html.twig';
        $number = $this->dice->roll();

        if (!is_int($number)) {
            return $this->render($template, array('message' => 'Dice has no numbers'));
        }

        if ($number % 2 === 0) {
            return $this->render($template, array('message' => 'even'));
        }

        return $this->render($template, array('message' => 'odd'));
    }
}
