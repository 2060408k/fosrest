<?php
/**
 * Created by PhpStorm.
 * User: pkourtellos
 * Date: 17/08/2017
 * Time: 12:06
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Chapter;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ChapterFixtures extends AbstractFixture implements OrderedFixtureInterface
{
	public function load( ObjectManager $manager )
	{

		$chapter1 = new Chapter();
		$chapter1->setId(1);
		$chapter1->setName("Chapter 1");
		$chapter1->setDescription("The Meeting of Jonathan and Lily");
		$chapter1->setPosition(1);
		$chapter1Characters = $chapter1->getCharacters();
		$chapter1Characters->add($this->getReference('character-character1'));
		$chapter1Characters->add($this->getReference('character-character2'));
		$chapter1->setCharacters($chapter1Characters);
		$chapter1Events = $chapter1->getEvents();
		$chapter1Events->add($this->getReference('event-event1'));
		$chapter1Events->add($this->getReference('event-event2'));
		$chapter1->setEvents($chapter1Events);
		$manager->persist($chapter1);

		$chapter2 = new Chapter();
		$chapter2->setId(1);
		$chapter2->setName("Chapter 2");
		$chapter2->setDescription("The Death of Jonathan");
		$chapter2->setPosition(2);
		$chapter2Characters = $chapter2->getCharacters();
		$chapter2Characters->add($this->getReference('character-character1'));
		$chapter2Characters->add($this->getReference('character-character2'));
		$chapter2Characters->add($this->getReference('character-character3'));
		$chapter2->setCharacters($chapter2Characters);
		$chapter2Events = $chapter2->getEvents();
		$chapter2Events->add($this->getReference('event-event3'));
		$chapter2->setEvents($chapter2Events);
		$manager->persist($chapter2);

        $this->addReference('chapter-chapter2',$chapter2);
        $this->addReference('chapter-chapter1',$chapter1);

		$manager->flush();
	}

	/**
	 * Get the order of this fixture
	 *
	 * @return integer
	 */
	function getOrder()
	{
		return 3;
	}
}