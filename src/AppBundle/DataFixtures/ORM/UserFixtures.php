<?php
/**
 * Created by PhpStorm.
 * User: pkourtellos
 * Date: 22/08/2017
 * Time: 12:08
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class UserFixtures extends AbstractFixture implements OrderedFixtureInterface,ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load( ObjectManager $manager )
    {
//        $factory = $this->container->get('security.encoder_factory');
//
//
//        $user1 = new User();
//        $user1->setId(1);
//        $user1->setEmail('kgblol059@gmail.com');
//        $user1->setIsActive(true);
//
//        $encoder = $factory->getEncoder($user1);
//        $password = 'test1234';
//        $encoded = $encoder->encodePassword($user1->getPassword().$user1->getSalt(), $password);
//
//        $user1->setPassword($encoded);
//        $user1->setUsername('admin');
//
//        $user1->setApiIdent($user1->generateAPIToken());
//
//        $manager->persist($user1);
//        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}