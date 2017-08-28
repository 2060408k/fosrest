<?php
/**
 * Created by PhpStorm.
 * User: pkourtellos
 * Date: 28/08/2017
 * Time: 09:46
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * BookProject
 *
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ChapterRepository")
 * @ORM\Table(name="book_project")
 */
class BookProject
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
     * One BookProject has Many Chapters.
     * @ORM\OneToMany(targetEntity="Chapter", mappedBy="bookProject")
     */
    private $chapters;

    /**
     * One BookProject has Many Characters.
     * @ORM\OneToMany(targetEntity="Character", mappedBy="bookProject")
     */
    private $characters;

    /**
     * One BookProject has Many Events.
     * @ORM\OneToMany(targetEntity="Event", mappedBy="bookProject")
     */
    private $events;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", nullable=false)
     */
    private $content;

    /**
     * Many BookProjects have One User.
     * @ORM\ManyToOne(targetEntity="User", inversedBy="bookProjects")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->chapters = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }


}