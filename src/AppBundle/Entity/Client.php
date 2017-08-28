<?php

namespace AppBundle\Entity;

use FOS\OAuthServerBundle\Entity\Client as BaseClient;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ClientRepository")
 */
class Client extends BaseClient
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="boolean")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $isActive=true;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getRandomId()
    {
        return $this->randomId;
    }

    /**
     * @param string $randomId
     */
    public function setRandomId($randomId)
    {
        $this->randomId = $randomId;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }


}