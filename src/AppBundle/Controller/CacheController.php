<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheController extends Controller
{
    /**
     * @Route("/cache", name="cache")
     */
    public function cache(Request $request)
    {
        $response = new Response('ok');
        $response->setCache(array(
            'etag'          => 'abcdef',
            'last_modified' => new \DateTime(),
            'max_age'       => 600,
            's_maxage'      => 600,
            'private'       => false,
            'public'        => true,
        ));

        // check if the Response validators (ETag, Last-Modified)
        // match a conditional value from the Request:
        $response->isNotModified($request);

        return $response;
    }
}
