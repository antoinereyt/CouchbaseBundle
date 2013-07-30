<?php

namespace Toiine\Bundle\CouchbaseBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Toiine\Bundle\CouchbaseBundle\DependencyInjection\Compiler\CouchbaseConnectionCompilerPass;

class ToiineCouchbaseBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new CouchbaseConnectionCompilerPass());
    }
}
