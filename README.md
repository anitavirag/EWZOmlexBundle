This bundle integrates the Omlex library into Symfony.

Installation
============

**Add OmlexBundle to your application kernel:**

    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new EWZ\Bundle\OmlexBundle\EWZOmlexBundle(),
            // ...
        );
    }

**Add the EWZ namespace to your autoloader:**

    // app/autoload.php
    $loader->registerNamespaces(array(
        // ...
        'EWZ'   => __DIR__.'/../src',
        'Omlex' => __DIR__.'/../vendor/omlex/lib',
        // ...
    ));
    

How to use
----------

In the controller we have some action. In this action we try to extract an oEmbed object from
a given url. 

    public function someAction() {
        ...

        // load service
        $oembed = $this->get('omlex.oembed');
        $oembed->setURL('http://www.flickr.com/photos/24887479@N06/2656764466/');

        // optional, if not provided it will be generated dynamically
        $oembed->setOption(Omlex\OEmbed::OPTION_API, 'http://www.flickr.com/services/oembed/');

        $object = $ombed->getObject();

        //echo $object->__toString();
        ...
    }
