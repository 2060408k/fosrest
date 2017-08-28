<?php
/**
 * Created by PhpStorm.
 * User: pkourtellos
 * Date: 17/08/2017
 * Time: 12:27
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * Chapter
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\EventRepository")
 * @ORM\Table(name="event")
 */
class Event
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
	 * @ORM\Column(name="description", type="string", length=100, nullable=false)
	 */
	private $description;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="name", type="string", length=100, nullable=false)
	 */
	private $name;

	/**
	 *
	 * One Event has Many Characters.
	 * @ORM\ManyToMany(targetEntity="Character", mappedBy="events")
	 */
	private $characters;

	/**
	 *
	 * One Event has Many Chapters.
	 * @ORM\ManyToMany(targetEntity="Chapter", mappedBy="events")
	 */
	private $chapters;

    /**
     * Many Event have One BookProject.
     * @ORM\ManyToOne(targetEntity="BookProject", inversedBy="events")
     * @ORM\JoinColumn(name="book_project_id", referencedColumnName="id")
     */
    private $bookProject;

	public function __construct()
	{
		$this->characters = new ArrayCollection();
		$this->chapters = new ArrayCollection();
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
	 * @return mixed
	 */
	public function getCharacters() {
		return $this->characters;
	}

	/**
	 * @param mixed $characters
	 */
	public function setCharacters( $characters ) {
		$this->characters = $characters;
	}

	/**
	 * @return mixed
	 */
	public function getChapters() {
		return $this->chapters;
	}

	/**
	 * @param mixed $chapters
	 */
	public function setChapters( $chapters ) {
		$this->chapters = $chapters;
	}

    public function expose() {
        return get_object_vars($this);
    }
}
