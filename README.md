EWZOmlexBundle
==============

This bundle integrates the Omlex (an oEmbed) library into Symfony.

## Installation

Open a command console, enter your project directory and run the following
command to download the latest stable version of this bundle:

```
composer require --dev excelwebzone/omlex-bundle
```

Next you will need to enable the bundle in your AppKernel class:


``` php
// app/AppKernel.php

// ...
// registerBundles()
if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
    // ...
    $bundles[] = new EWZ\Bundle\OmlexBundle\EWZOmlexBundle();
}
```

Congratulations! You're ready!

## Basic Usage

The following will try to extract an oEmbed object from a given url:

``` php
<?php

$url = 'https://www.flickr.com/photos/24887479@N06/2656764466/';

// optional, if not provided it will be generated dynamically
$endpoint = 'https://www.flickr.com/services/oembed/';

// optional, preload providers (can also be added by using addProvider() function)
$providers = [
    // as Provider object
    new \Omlex\Provider(
        'https://lab.viddler.com/services/oembed/',
        [
            'https://*.viddler.com/*',
        ],
        'https://www.viddler.com',
        'Viddler'
    ),

    // as array
    [
        'endpoint' => 'https://qik.com/api/oembed.json', // or xml
        'schemes' => [
            'https://qik.com/video/*',
            'https://qik.com/*',
        ],
        'url' => 'https://qik.com',
        'name' => 'Qik'
    ],
];

// load service
$oembed = $this->get('ewz_omlex.oembed');
$oembed->setURL($url, $enpoint, $providers);

$object = $oembed->getObject();

//echo $object->__toString();
```
