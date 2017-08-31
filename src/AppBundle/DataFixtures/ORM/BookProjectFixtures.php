<?php
/**
 * Created by PhpStorm.
 * User: pkourtellos
 * Date: 28/08/2017
 * Time: 10:51
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\BookProject;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class BookProjectFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load( ObjectManager $manager )
    {
        $bookProject = new BookProject();

        $bookProject->setId(1);
        $bookProject->setName('Rick and Morty: The tale');
        $bookProject->setContent('Wabba laba dub dub');

        /** @var ArrayCollection $chapters */
        $chapters = $bookProject->getChapters();
        $chapters->add($this->getReference('chapter-chapter1'));
        $chapters->add($this->getReference('chapter-chapter2'));

        /** @var ArrayCollection $characters */
        $characters = $bookProject->getCharacters();
        $characters->add($this->getReference('character-character1'));
        $characters->add($this->getReference('character-character2'));
        $characters->add($this->getReference('character-character3'));

        /** @var ArrayCollection $events */
        $events = $bookProject->getEvents();
        $events->add($this->getReference('event-event1'));
        $events->add($this->getReference('event-event2'));
        $events->add($this->getReference('event-event3'));

        $bookProject->setChapters($chapters);
        $bookProject->setCharacters($characters);
        $bookProject->setEvents($events);

        $this->addReference('bookProject-bookProject1',$bookProject);

        $manager->persist($bookProject);
        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}