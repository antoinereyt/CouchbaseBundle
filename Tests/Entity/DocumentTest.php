<?php

namespace Toiine\CouchbaseBundle\Tests\Entity;

use Toiine\CouchbaseBundle\Entity\Document;

class DocumentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Toiine\CouchbaseBundle\Entity\Document::__construct()
     */
    public function testConstructor()
    {
        $doc = new Document('key', 'value');
        $this->assertEquals('key', $doc->getKey());
        $this->assertEquals('value', $doc->getValue());
    }
}
