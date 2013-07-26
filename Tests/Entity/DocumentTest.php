<?php

namespace Toiine\Bundle\CouchbaseBundle\Tests\Entity;

use Toiine\Bundle\CouchbaseBundle\Entity\Document;

class DocumentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Toiine\Bundle\CouchbaseBundle\Entity\Document::__construct()
     */
    public function testConstructor()
    {
        $doc = new Document('key', 'value');
        $this->assertEquals('key', $doc->getKey());
        $this->assertEquals('value', $doc->getValue());
    }
}
