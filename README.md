EWZOmlexBundle
==============

This bundle integrates the Omlex (an oEmbed) library into Symfony.

## Installation

Installation depends on how your project is setup:

### Step 1: Installation using the `bin/vendors.php` method

If you're using the `bin/vendors.php` method to manage your vendor libraries,
add the following entries to the `deps` in the root of your project file:

```
[EWZTimeBundle]
    git=http://github.com/excelwebzone/EWZOmlexBundle.git
    target=/bundles/EWZ/Bundle/OmlexBundle

; Dependency:
;-----------
[Omlex]
    git=http://github.com/excelwebzone/Omlex.git
    target=omlex
```

Next, update your vendors by running:

``` bash
$ ./bin/vendors
```

Great! Now skip down to *Step 2*.

### Step 1 (alternative): Installation with submodules

If you're managing your vendor libraries with submodules, first create the
`vendor/bundles/EWZ/Bundle` directory:

``` bash
$ mkdir -pv vendor/bundles/EWZ/Bundle
```

Next, add the necessary submodules:

``` bash
$ git submodule add git://github.com/excelwebzone/Omlex.git vendor/omlex
$ git submodule add git://github.com/excelwebzone/EWZOmlexBundle.git vendor/bundles/EWZ/Bundle/OmlexBundle
```

### Step2: Configure the autoloader

Add the following entry to your autoloader:

``` php
<?php
// app/autoload.php

$loader->registerNamespaces(array(
    // ...

    'Omlex' => __DIR__.'/../vendor/omlex/lib',
    'EWZ'   => __DIR__.'/../vendor/bundles',
));
```

### Step3: Enable the bundle

Finally, enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...

        new EWZ\Bundle\OmlexBundle\EWZOmlexBundle(),
    );
}
```

### Step4: Configure the bundle's

Finally, add the following to your config file:

``` yaml
# app/config/config.yml

ewz_omlex:
    providers:
        qik:
            endpoint: "http://lab.viddler.com/services/oembed/"
            schemes: ["http://qik.com/video/*", "http://qik.com/*"]
            url: "http://qik.com"
            name: "Qik"
```

Congratulations! You're ready!

## Basic Usage

The following will try to extract an oEmbed object from a given url:

``` php
<?php

$url = 'http://www.flickr.com/photos/24887479@N06/2656764466/';

// optional, if not provided it will be generated dynamically
$endpoint = 'http://www.flickr.com/services/oembed/';

// optional, preload providers (can also be added by using addProvider() function)
$providers = array(
    // as Provider object
    new \Omlex\Provider(
        'http://lab.viddler.com/services/oembed/',
        array(
            'http://*.viddler.com/*',
        ),
        'http://www.viddler.com',
        'Viddler'
    ),

    // as array
    array(
        'endpoint' => 'http://qik.com/api/oembed.json', // or xml
        'schemes'  => array(
            'http://qik.com/video/*',
            'http://qik.com/*',
        ),
        'url'      => 'http://qik.com',
        'name'     => 'Qik'
    ),
);

// load service
$oembed = $this->get('ewz_omlex.oembed');
$oembed->setURL($url, $enpoint, $providers);

$object = $oembed->getObject();

//echo $object->__toString();
```
