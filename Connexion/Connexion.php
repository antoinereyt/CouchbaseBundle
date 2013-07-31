<?php

namespace Toiine\Bundle\CouchbaseBundle\Connexion;

use Couchbase;

/**
 * Represent a Couchbase Connexion.
 */
class Connexion implements ConnexionInterface
{
    /**
     * Connexion to a Couchbase bucket
     * @var Couchbase
     */
    protected $couchbase;

    /**
     * Constructor.
     *
     * @param Couchbase $couchbase
     */
    public function __construct(Couchbase $couchbase)
    {
        $this->couchbase = $couchbase;
    }
}
