<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Chapter;
use AppBundle\Entity\Character;
use AppBundle\Entity\Event;
use AppBundle\Entity\Repository\BookProjectRepository;
use AppBundle\Entity\Repository\ChapterRepository;
use AppBundle\Entity\Repository\CharacterRepository;
use AppBundle\Entity\Repository\EventRepository;
use AppBundle\Entity\User;
use AppBundle\Form\BookProjectForm;
use AppBundle\Entity\BookProject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

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
     *  @Rest\Get("/chapters/{bookProjectId}")
     */
    public function getChaptersAction(Request $request,$bookProjectId)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $entityManager = $this->getDoctrine()->getManager();

        /** @var ChapterRepository $chapterRepo */
        $chapterRepo = $entityManager->getRepository(Chapter::class);

        $chapters = $chapterRepo->getChaptersByBookProjectId($bookProjectId);

        $response = new JsonResponse($chapters,200,['Access-Control-Allow-Origin' => 'http://localhost:4200/']);

        return $response;
    }

    /**
     *  @Rest\Get("/characters/{bookProjectId}")
     */
    public function getCharactersAction(Request $request,$bookProjectId)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        $entityManager = $this->getDoctrine()->getManager();
        /** @var CharacterRepository $characterRepo */
        $characterRepo = $entityManager->getRepository(Character::class);

        $characters = $characterRepo->getCharactersByBookProjectId($bookProjectId) ;

        $response = new JsonResponse($characters,200,['Access-Control-Allow-Origin' => 'http://localhost:4200/']);

        return $response;
    }

    /**
     *  @Rest\Get("/events/{bookProjectId}")
     */
    public function getEventsAction(Request $request,$bookProjectId)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $entityManager = $this->getDoctrine()->getManager();
        /** @var EventRepository $eventRepo */
        $eventRepo = $entityManager->getRepository(Event::class);
        $events = $eventRepo->getEventsByBookProjectId($bookProjectId);

        $response = new JsonResponse($events,200, ['Access-Control-Allow-Origin', 'http://localhost:4200/']);

        return $response;
    }


    /**
     *  @Rest\Get("/getBookProjects")
     */
    public function getBookProjectsAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $entityManager = $this->getDoctrine()->getManager();
        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();
        /** @var BookProjectRepository $bookProjectRepo */
        $bookProjectRepo = $entityManager->getRepository(BookProject::class);
        $events = $bookProjectRepo->getBookProjectsByUserId($user->getId());

        $response = new JsonResponse($events,200, ['Access-Control-Allow-Origin', 'http://localhost:4200/']);

        return $response;
    }

    /**
     *  @Rest\Post("/postBookProjects")
     */
    public function postBookProjectsAction(Request $request)
    {
        if(!$request->isMethod('POST')) {
            return new Response('Not a POST request',400);
        }

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        $data = json_decode($request->getContent(), true);

        $bookProject = new BookProject();

        $form = $this->createForm(BookProjectForm::class, $bookProject);

        $form->submit($data);

        if($form->isValid()){
            /** @var User $user */
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $bookProject->setUser($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bookProject);
            $entityManager->flush();
        }

        $response = new JsonResponse(null,200, ['Access-Control-Allow-Origin', 'http://localhost:4200/']);

        return $response;
    }

    /**
     *  @Rest\Delete("/deleteBookProjects/{id}")
     */
    public function deleteBookProjectsAction(Request $request,$id)
    {
        if(!$request->isMethod('DELETE')) {
            return new Response('Not a DELETE request',400);
        }

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $entityManager = $this->getDoctrine()->getManager();
        $bookProjectRepo = $entityManager->getRepository(BookProject::class);
        $bookProject = $bookProjectRepo->find($id);
        $entityManager->remove($bookProject);
        $entityManager->flush();

        $response = new JsonResponse(null,200, ['Access-Control-Allow-Origin', 'http://localhost:4200/']);

        return $response;
    }

}
