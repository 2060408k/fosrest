<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 * Chapter
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\CharacterRepository")
 * @ORM\Table(name="`character`")
 */
class Character
{
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="name", type="string", nullable=true)
	 */
	private $name;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="surname", type="string", nullable=true)
	 */
	private $surname;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="dob", type="datetime", nullable=true)
	 */
	private $dob;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="origin", type="string", nullable=true)
	 */
	private $origin;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="skills", type="string", nullable=true)
	 */
	private $skills;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 *
	 * @ORM\ManyToMany(targetEntity="Chapter", mappedBy="characters")
	 */
	private $chapters;

	/**
	 * @var Collection
	 *
	 * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Event", inversedBy="characters", indexBy="id")
	 * @ORM\JoinTable(name="event_character",
	 *   joinColumns={
	 *     @ORM\JoinColumn(name="character_id", referencedColumnName="id")
	 *   },
	 *   inverseJoinColumns={
	 *     @ORM\JoinColumn(name="event_id", referencedColumnName="id")
	 *   }
	 * )
	 */
	private $events;

    /**
     * Many Characters have One BookProject.
     * @ORM\ManyToOne(targetEntity="BookProject", inversedBy="characters")
     * @ORM\JoinColumn(name="book_project_id", referencedColumnName="id")
     */
    private $bookProject;

	public function __construct()
	{
		$this->chapters = new ArrayCollection();
		$this->events = new ArrayCollection();
	}

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId( $id ) {
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName( $name ) {
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getSurname() {
		return $this->surname;
	}

	/**
	 * @param string $surname
	 */
	public function setSurname( $surname ) {
		$this->surname = $surname;
	}

	/**
	 * @return \DateTime
	 */
	public function getDob() {
		return $this->dob;
	}

	/**
	 * @param \DateTime $dob
	 */
	public function setDob( $dob ) {
		$this->dob = $dob;
	}

	/**
	 * @return string
	 */
	public function getOrigin() {
		return $this->origin;
	}

	/**
	 * @param string $origin
	 */
	public function setOrigin( $origin ) {
		$this->origin = $origin;
	}

	/**
	 * @return string
	 */
	public function getSkills() {
		return $this->skills;
	}

	/**
	 * @param string $skills
	 */
	public function setSkills( $skills ) {
		$this->skills = $skills;
	}

	/**
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getChapters() {
		return $this->chapters;
	}

	/**
	 * @param \Doctrine\Common\Collections\Collection $chapters
	 */
	public function setChapters( $chapters ) {
		$this->chapters = $chapters;
	}

	/**
	 * @return Collection
	 */
	public function getEvents() {
		return $this->events;
	}

	/**
	 * @param Collection $events
	 */
	public function setEvents( $events ) {
		$this->events = $events;
	}

	public function expose() {
		return get_object_vars($this);
	}
}
