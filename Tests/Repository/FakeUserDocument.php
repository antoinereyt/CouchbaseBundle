<?php

namespace Toiine\CouchbaseBundle\Tests\Repository;

use Toiine\CouchbaseBundle\Entity\DocumentInterface;

class FakeUserDocument implements DocumentInterface
{
    /**
     * @var string
     *
    */
    public $firstname;

    /**
     * @var string
     *
    */
    public $name;

    public function getKey()
    {
        return sprintf('%s-%s', strtolower($this->getFirstname()), strtolower($this->getName()));
    }

    public function __construct($firstname = null, $name = null)
    {
        if (! is_null($firstname)) {
            $this->firstname = $firstname;
        }

        if (! is_null($name)) {
            $this->name = $name;
        }
    }

    /**
     * Gets the value of name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the value of name.
     *
     * @param string $name the name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets the value of firstname.
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Sets the value of firstname.
     *
     * @param string $firstname the firstname
     *
     * @return self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }
}
