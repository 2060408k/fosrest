<?php
/**
 * Created by PhpStorm.
 * User: pkourtellos
 * Date: 16/08/2017
 * Time: 15:28
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * Chapter
 *
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ChapterRepository")
 * @ORM\Table(name="chapter")
 */
class Chapter
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
	 * @ORM\Column(name="name", type="string", nullable=false)
	 */
	private $name;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="description", type="string", nullable=false)
	 */
	private $description;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="position", type="integer", nullable=false)
	 */
	private $position;

	/**
	 * @var Collection
	 *
	 * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Character", inversedBy="chapters", indexBy="id")
	 * @ORM\JoinTable(name="chapter_character",
	 *   joinColumns={
	 *     @ORM\JoinColumn(name="chapter_id", referencedColumnName="id")
	 *   },
	 *   inverseJoinColumns={
	 *     @ORM\JoinColumn(name="character_id", referencedColumnName="id")
	 *   }
	 * )
	 */
	private $characters;

	/**
	 * @var Collection
	 *
	 * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Event", inversedBy="chapters", indexBy="id")
	 * @ORM\JoinTable(name="chapter_event",
	 *   joinColumns={
	 *     @ORM\JoinColumn(name="chapter_id", referencedColumnName="id")
	 *   },
	 *   inverseJoinColumns={
	 *     @ORM\JoinColumn(name="event_id", referencedColumnName="id")
	 *   }
	 * )
	 */
	private $events;

    /**
     * Many Chapters have One BookProject.
     * @ORM\ManyToOne(targetEntity="BookProject", inversedBy="chapters")
     * @ORM\JoinColumn(name="book_project_id", referencedColumnName="id")
     */
	private $bookProject;

	public function __construct()
	{
		$this->characters = new ArrayCollection();
		$this->events = new ArrayCollection();
		$this->bookProject = new ArrayCollection();
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
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param string $description
	 */
	public function setDescription( $description ) {
		$this->description = $description;
	}

	/**
	 * @return int
	 */
	public function getPosition() {
		return $this->position;
	}

	/**
	 * @param int $position
	 */
	public function setPosition( $position ) {
		$this->position = $position;
	}

	public function expose() {
		return get_object_vars($this);
	}

	/**
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getCharacters() {
		return $this->characters;
	}

	/**
	 * @param \Doctrine\Common\Collections\Collection $characters
	 */
	public function setCharacters( $characters ) {
		$this->characters = $characters;
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
}