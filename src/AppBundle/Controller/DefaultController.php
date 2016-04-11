<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }

    /**
     * Reads a files content.
     *
     * @Route("/file/content", name="file")
     */
    public function fileAction()
    {
       return new BinaryFileResponse($this->getParameter('kernel.root_dir') . '/../composer.json');
    }

    /**
     * Downloads a file.
     *
     * @Route("/file/download", name="download")
     */
    public function downloadAction()
    {
        $response = new BinaryFileResponse($this->getParameter('kernel.root_dir') . '/../composer.json');
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'composer.json');

        return $response;
    }

    /**
     * Returns a json file.
     *
     * @Route("/file/json", name="json")
     */
    public function jsonAction()
    {
        return new JsonResponse([ 'test' => 123 ]);
    }

    /**
     * Returns a json file with jsonp.
     *
     * @Route("/file/jsonp", name="json")
     */
    public function jsonpAction()
    {
        $response = new JsonResponse([ 'test' => 123 ]);
        $response->setCallback('handleResponse');

        return $response;
    }

}
