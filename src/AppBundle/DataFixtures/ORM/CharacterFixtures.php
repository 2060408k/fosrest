<?php
/**
 * Created by PhpStorm.
 * User: pkourtellos
 * Date: 16/08/2017
 * Time: 15:48
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Character;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
class CharacterFixtures extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$character1 = new Character();
		$character1->setId(1);
		$character1->setName('Lily');
		$character1->setSurname('Lockhart');
		$datetime = new \DateTime();
		$datetime->setDate(1994,7,8);
		$character1->setDob($datetime);
		$character1->setOrigin('The Old Forest');
		$character1->setSkills('swimming');
		$character1events = $character1->getEvents();
		$character1events->add($this->getReference('event-event1'));
		$character1events->add($this->getReference('event-event2'));
		$character1->setEvents($character1events);
		$manager->persist($character1);

		$character2 = new Character();
		$character2->setId(2);
		$character2->setName('Jonathan');
		$character2->setSurname('Meowitch');
		$datetime = new \DateTime();
		$datetime->setDate(1993,10,7);
		$character2->setDob($datetime);
		$character2->setOrigin('The New Forest');
		$character2->setSkills('flying');
		$character2events = $character2->getEvents();
		$character2events->add($this->getReference('event-event2'));
		$character2events->add($this->getReference('event-event3'));
		$character2->setEvents($character2events);
		$manager->persist($character2);

		$character3 = new Character();
		$character3->setId(3);
		$character3->setName('Jack');
		$character3->setSurname('The Reaper');
		$datetime = new \DateTime();
		$datetime->setDate(1993,10,8);
		$character3->setDob($datetime);
		$character3->setOrigin('London');
		$character3->setSkills('killing');
		$character3events = $character3->getEvents();
		$character3events->add($this->getReference('event-event3'));
		$character3->setEvents($character3events);
		$manager->persist($character3);

		$this->addReference('character-character1', $character1);
		$this->addReference('character-character2', $character2);
		$this->addReference('character-character3', $character3);

		$manager->flush();
	}

	/**
	 * Get the order of this fixture
	 *
	 * @return integer
	 */
	function getOrder()
	{
		return 2;
	}
}