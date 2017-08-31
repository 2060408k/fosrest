<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\UserRepository")
 * @ORM\Table(name="user")
 * @UniqueEntity("username")
 * @UniqueEntity("email")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    protected $id;

    /**
     * One User has Many BookProjects.
     * @ORM\OneToMany(targetEntity="BookProject", mappedBy="user")
     */
    private $bookProjects;

    public function __construct()
    {
        parent::__construct();

        $this->bookProjects = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getBookProjects()
    {
        return $this->bookProjects;
    }

    /**
     * @param mixed $bookProjects
     */
    public function setBookProjects($bookProjects)
    {
        $this->bookProjects = $bookProjects;
    }

    public function expose() {
        return get_object_vars($this);
    }


}