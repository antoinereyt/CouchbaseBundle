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
        return sprintf('%s-%s', strtolower($this->firstname), strtolower($this->name));
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
}
