<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentNegotiationController extends Controller
{
    /**
     * @Route("/negotiation/content", name="negotiation_content")
     *
     * @example http http://localhost:8000/negotiation/content Accept:text/html
     * @example http http://localhost:8000/negotiation/content Accept:application/json
     */
    public function negotiationContentAction(Request $request)
    {
        if (in_array('application/json', $request->getAcceptableContentTypes(), true)) {
            return new JsonResponse($request->getAcceptableContentTypes());
        }

        return new Response(print_r($request->getAcceptableContentTypes(), true));
    }

    /**
     * @Route("/negotiation/language", name="negotiation_language")
     *
     * @example http http://localhost:8000/negotiation/language Accept-Language:nl
     * @example http http://localhost:8000/negotiation/language Accept-Language:de
     */
    public function negotiationLanguageAction(Request $request)
    {
        $request->setLocale($request->getPreferredLanguage(['en', 'nl']));

        return new Response($request->getLocale());
    }
}
