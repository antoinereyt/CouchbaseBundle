<?php

namespace Toiine\Bundle\CouchbaseBundle\Tests\DependencyInjection\Compiler;

use Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler\AbstractCompilerPass;

class CompilerPass extends AbstractCompilerPass
{
    public function getServiceId($name)
    {
        return '';
    }

    public function getDefinition($name, array $params)
    {
        null;
    }
}

class AbstractCompilerPassTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->compiler = new CompilerPass();
    }

    /** @covers Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler\AbstractCompilerPass::generateConnectionServiceId */
    public function testGenerateConnectionServiceId()
    {
        $serviceId = $this->compiler->generateConnectionServiceId('foo');
        $this->assertEquals('couchbase.connection.foo', $serviceId);
    }

    /** @covers Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler\AbstractCompilerPass::generateDocumentManagerServiceId */
    public function testGenerateDocumentManagerServiceId()
    {
        $serviceId = $this->compiler->generateDocumentManagerServiceId('foo');
        $this->assertEquals('couchbase.document_manager.foo', $serviceId);
    }

    /** @covers Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler\AbstractCompilerPass::generateRepositoryServiceId */
    public function testGenerateRepositoryServiceId()
    {
        $serviceId = $this->compiler->generateRepositoryServiceId('foo');
        $this->assertEquals('couchbase.repository.foo', $serviceId);
    }
}
