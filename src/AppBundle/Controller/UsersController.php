<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\UserBundle\Model\UserManager;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

class UsersController extends FOSRestController implements ClassResourceInterface
{
    public function cgetAction()
    {
        //security.yml is configured to allow anonymous access to controllers
        //checking for authorization in each controller allows more flexibility
        //to change this remove anonymous: true in security.yml on firewall
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository("AppBundle:User");
        $users = $repository->findAll();

        $view = $this->view($users, 200)
            ->setTemplate("default/users.html.twig")
            ->setTemplateVar('users')
        ;


        return $this->handleView($view);
    }

    public function postAction(Request $request)
    {
        /** @var UserManager $userManager */
        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $user->setEnabled(true);

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $user->setPlainPassword($user->getPassword());
            $userManager->updateUser($user);

            $view = $this->view($user, 200);
            return $this->handleView($view);
        }

        $view = $this->view($form->getErrors(), 409);
        return $this->handleView($view);
    }


    /**
     * @Route("/register", name="register")
     *
     * @return Response
     */
    public function registerUser(Request $request)
    {

        if($request->isMethod('GET')) {
            return new Response('Not a GET request',400);
        }


        /** @var UserManager $userManager */
        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $user->setEnabled(true);

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $user->setPlainPassword($user->getPassword());
            $userManager->updateUser($user);

            $view = $this->view($user, 200);
            return $this->handleView($view);
        }
        $out =
            [
                '1' => $form->getErrors(),
                '2' => $form
            ]
        ;
        $view = $this->view($out, 409);
        return $this->handleView($view);
    }
}
