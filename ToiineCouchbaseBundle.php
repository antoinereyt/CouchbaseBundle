<?php

namespace Toiine\Bundle\CouchbaseBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler\ConnectionCompilerPass;
use Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler\DocumentManagerCompilerPass;
use Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler\RepositoryCompilerPass;

class ToiineCouchbaseBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ConnectionCompilerPass());
        $container->addCompilerPass(new DocumentManagerCompilerPass());
        $container->addCompilerPass(new RepositoryCompilerPass());
    }
}
