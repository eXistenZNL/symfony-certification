<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;

class CookieController extends Controller
{
    /**
     * @Route("/cookie", name="cookie")
     */
    public function cookie()
    {
        $response = new Response('ok');
        $response->headers->setCookie(
            // (name, $value = null, $expire = 0, $path = '/', $domain = null, $secure = false, $httpOnly = true)
            new Cookie('key', 'value')
        );

        // In response headers
        // Set-Cookie:key=value; path=/; httponly
        return $response;
    }
}
