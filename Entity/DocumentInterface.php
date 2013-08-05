<?php

namespace Toiine\CouchbaseBundle\Entity;

interface DocumentInterface
{
    /**
     * Get the key of the Document.
     *
     * @return string
     */
    public function getKey();
}
