<?php

namespace Toiine\CouchbaseBundle\Tests\Serializer\Fixture;

use Toiine\CouchbaseBundle\Entity\DocumentInterface;

class FakeBookDocument implements DocumentInterface
{
    /** @var string */
    public $title;

    /** @var string */
    public $author;

    /** @var string */
    public $isbn;

    /** @var string */
    public $dimensions;

    /** @var string */
    public $weigth;

    public function getKey()
    {
        return $this->isbn;
    }
}
