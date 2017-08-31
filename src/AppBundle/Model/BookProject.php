<?php

namespace AppBundle\Model;

class BookProject
{
    /** @var  string */
    private $name;

    /** @var  string */
    private $content;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return BookProject
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
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
     * @return BookProject
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }
}
