<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use FOS\UserBundle\Model\UserManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserFixtures extends AbstractFixture implements OrderedFixtureInterface,ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load( ObjectManager $manager )
    {
        /** @var UserManager $userManager */
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $user->setEnabled(true);
        $user->setPassword('telis');
        $user->setPlainPassword($user->getPassword());
        $user->setUsername('telis');
        $user->setEmail('telis@telis.com');


        /** @var ArrayCollection $bookProjects */
        $bookProjects = $user->getBookProjects();
        $bookProjects->add($this->getReference('bookProject-bookProject1'));
        $user->setBookProjects($bookProjects);

        $userManager->updateUser($user);

        $manager->persist($user);
        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }

}