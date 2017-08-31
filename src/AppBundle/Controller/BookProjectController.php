<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BookProject;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Bookproject controller.
 *
 * @Route("bookproject")
 */
class BookProjectController extends Controller
{
    /**
     * Lists all bookProject entities.
     *
     * @Route("/", name="bookproject_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bookProjects = $em->getRepository('AppBundle:BookProject')->findAll();

        return $this->render('bookproject/index.html.twig', array(
            'bookProjects' => $bookProjects,
        ));
    }

    /**
     * Finds and displays a bookProject entity.
     *
     * @Route("/{id}", name="bookproject_show")
     * @Method("GET")
     */
    public function showAction(BookProject $bookProject)
    {

        return $this->render('bookproject/show.html.twig', array(
            'bookProject' => $bookProject,
        ));
    }
}
