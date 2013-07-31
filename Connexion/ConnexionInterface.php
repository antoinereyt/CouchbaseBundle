<?php

namespace Toiine\Bundle\CouchbaseBundle\Connexion;

interface ConnexionInterface
{
    /**
     * Connexion to a Couchbase bucket
     * @var Couchbase
     */
    protected $couchbase;
}
