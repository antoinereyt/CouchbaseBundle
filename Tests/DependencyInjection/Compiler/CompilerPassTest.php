<?php

namespace Toiine\Bundle\CouchbaseBundle\Tests\DependencyInjection\Compiler;

use Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler\CompilerPass;

class CompilerPassTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->compiler = new CompilerPass();
    }

    /** @covers Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler\CompilerPass::generateConnectionServiceId */
    public function testGenerateConnectionServiceId()
    {
        $serviceId = $this->compiler->generateConnectionServiceId('foo');
        $this->assertEquals('couchbase.connection.foo', $serviceId);
    }

    /** @covers Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler\CompilerPass::generateDocumentManagerServiceId */
    public function testGenerateDocumentManagerServiceId()
    {
        $serviceId = $this->compiler->generateDocumentManagerServiceId('foo');
        $this->assertEquals('couchbase.document_manager.foo', $serviceId);
    }

    /** @covers Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler\CompilerPass::generateRepositoryServiceId */
    public function testGenerateRepositoryServiceId()
    {
        $serviceId = $this->compiler->generateRepositoryServiceId('foo');
        $this->assertEquals('couchbase.repository.foo', $serviceId);
    }
}
