# caribu-mvc-bootstrap
Bootstrap addon for Caribu MVC

This is an addon for Caribu MVC to work with bootstrap as view.

composer.json:
```json
{
  "require" : {
    "nkey/caribu-mvc" : "dev-master",
    "nkey/caribu-mvc-bootstrap" : "dev-master",
    "nkey/phpgenerics" : "dev-master",
    "psr/log" : "1.0.0"
  }
}
```

public/index.php:
```php
<?php
namespace Nkey\Caribu\Mvc\Tests;

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use Nkey\Caribu\Mvc\Controller\AbstractController;
use Nkey\Caribu\Mvc\Application;

class BootstrapTestController extends AbstractController
{
    /**
     * @webMethod
     */
    public function index()
    {
        $this->response->addHeader('Last-modified', \DateTime::createFromFormat('U', filemtime(__FILE__))->format(\DateTime::RFC2822));

        echo '<div class="panel panel-default">';
        echo '<div class="panel-body">';
        echo '<h2>Hello Caribu Bootstrap!</h2>';
        echo '</div>';
        echo '</div>';
    }
}

Application::getInstance()->registerView('\Nkey\Caribu\Mvc\View\BootstrapView')
    ->registerController('\Nkey\Caribu\Mvc\Tests\BootstrapTestController')
    ->setDefaults('BootstrapTest');

Application::getInstance()->serve();
```
