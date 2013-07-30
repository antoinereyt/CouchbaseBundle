CouchbaseBundle
===============

Symfony2 bundle to manipulate Couchbase Documents.

[![Build Status](https://travis-ci.org/toiine/CouchbaseBundle.png?branch=master)](https://travis-ci.org/toiine/CouchbaseBundle) [![Build Status](https://travis-ci.org/toiine/CouchbaseBundle.png?branch=develop)](https://travis-ci.org/toiine/CouchbaseBundle) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/aed516f2-7cab-4fcb-a93a-e435a126a0a9/mini.png)](https://insight.sensiolabs.com/projects/aed516f2-7cab-4fcb-a93a-e435a126a0a9)

## Installation

Installing the bundle via packagist is the quickest and simplest method of installing the bundle. Here are the steps:

### Step 1: Composer require

    $ php composer.phar require "toiine/couchbasebundle":"dev-master"

### Step 2: Enable the bundle in the kernel
```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Toiine\Bundle\CouchbaseBundle\ToiineCouchbaseBundle(),
        // ...
    );
}
```

## Configuration

There is a sample configuration file in Resources/config/couchbase.yml.dist

```yml
connections:
  conn1:
    # default is "localhost"
    # host:
    # default is 8091
    # port:
    username: admin
    password: admin
    bucket: default
  conn2:
    host: couchbase.tld
    port: 8092
    username: couchbase
    password: cOuchb4s3
    bucket: bucket2
```
