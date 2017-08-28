<?php
/**
 * Created by PhpStorm.
 * User: pkourtellos
 * Date: 17/08/2017
 * Time: 13:49
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Event;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class EventFixtures extends AbstractFixture implements OrderedFixtureInterface
{
	public function load( ObjectManager $manager ) {
		$event1 = new Event();
		$event1->setId(1);
		$event1->setName('LilyWalkedPark');
		$event1->setDescription('Lily walked for the first time in the park');
		$manager->persist($event1);

		$event2 = new Event();
		$event2->setId(2);
		$event2->setName('JonathanMetLily');
		$event2->setDescription('Jonathan met Lily');
		$manager->persist($event2);

		$event3 = new Event();
		$event3->setId(3);
		$event3->setName('JonathanKilledByJack');
		$event3->setDescription('Jack slaughtered Jonathan');
		$manager->persist($event3);

		$this->addReference('event-event1', $event1);
		$this->addReference('event-event2', $event2);
		$this->addReference('event-event3', $event3);

		$manager->flush();
	}

	public function getOrder() {
		return 1;
	}

}