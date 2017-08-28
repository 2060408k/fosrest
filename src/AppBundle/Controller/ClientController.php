<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Client;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends FOSRestController implements ClassResourceInterface
{
    /**
     * @Route("/getclient", name="getclient")
     *
     * @return Response
     */
    public function getClientAction(Request $request)
    {
        if(!$request->isMethod('GET')) {
            return new Response('Not a GET request',400);
        }

        $clientRepository = $this->getDoctrine()->getRepository('AppBundle:Client');

        /** @var Client $client */
        $client = $clientRepository->findOneBy(['isActive' => 1]);

        $data = [
            'id' => $client->getId().'_'.$client->getRandomId(),
            'secret' =>$client->getSecret()
            ]
        ;
        $response = new JsonResponse($data,200);

        return $response;
    }
}