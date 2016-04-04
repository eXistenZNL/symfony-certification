<?php

namespace AppBundle\Controller;

use AppBundle\Service\D6Dice;
use AppBundle\Service\DiceInterface;
use AppBundle\Service\SixSidedDice;
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

    public function __construct(DiceInterface $dice)
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

    /**
     * Roll all Dice services in the container and count the output
     *
     * @param Request $request
     *
     * @return Response
     */
    public function rollAllAction(Request $request)
    {
        $rollableServices = $this->findTaggedServiceIds('app.rollable');
        $rollCount = 0;
        $total = 0;
        foreach ($rollableServices as $rollableService) {
            $outcome = $rollableService->roll();
            if (!is_int($outcome)) {
                continue;
            }

            $rollCount++;
            $total = $total + $outcome;
        }

        return $this->render(
            'default/oneLine.html.twig',
            array('message' => sprintf('rolled %d times with a total of %s', $rollCount, $total))
        );
    }
}
