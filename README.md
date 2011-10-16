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

**Add additional providers in configuration file:**

    // app/config/config.yml
    // ...
    ewz_omlex:
        providers:
            qik:
                endpoint: "http://lab.viddler.com/services/oembed/"
                schemes: ["http://qik.com/video/*", "http://qik.com/*"]
                url: "http://qik.com"
                name: "Qik"
    

How to use
----------

In the controller we have some action. In this action we try to extract an oEmbed object from
a given url. 

    public function someAction() {
        ...

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
        $oembed = $this->get('omlex.oembed');
        $oembed->setURL($url, $enpoint, $providers);

        $object = $oembed->getObject();

        //echo $object->__toString();
        ...
    }
