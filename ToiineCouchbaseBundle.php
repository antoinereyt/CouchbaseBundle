<?php

namespace Toiine\CouchbaseBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Toiine\CouchbaseBundle\DependencyInjection\Compiler\CouchbaseCompilerPass;
use Toiine\CouchbaseBundle\DependencyInjection\Compiler\ConnectionCompilerPass;
use Toiine\CouchbaseBundle\DependencyInjection\Compiler\DocumentManagerCompilerPass;
use Toiine\CouchbaseBundle\DependencyInjection\Compiler\RepositoryCompilerPass;

class ToiineCouchbaseBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new CouchbaseCompilerPass());
        $container->addCompilerPass(new ConnectionCompilerPass());
        $container->addCompilerPass(new DocumentManagerCompilerPass());
        $container->addCompilerPass(new RepositoryCompilerPass());
    }
}
