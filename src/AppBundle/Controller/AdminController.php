<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * @Route("/security/guest", name="guest")
     */
    public function guestAction(Request $request)
    {
        return $this->render('default/index.html.twig', ['base_dir' => '']);
    }

    /**
     * @Route("/security/admin", name="admin")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', ['base_dir' => '']);
    }

    /**
     * @Route("/security/logout", name="logout")
     */
    public function logoutAction(Request $request)
    {
        return new Response('', 401);
    }
}
