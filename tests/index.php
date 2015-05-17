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
        $this->response->addHeader(
            'Last-modified',
            \DateTime::createFromFormat('U', filemtime(__FILE__))->format(\DateTime::RFC2822)
        );

        echo '<div class="panel panel-default">';
        echo '<div class="panel-body">';
        echo '<h2>Hello Caribu Bootstrap!</h2>';
        echo '</div>';
        echo '</div>';
    }
}

Application::getInstance()->registerView('\Nkey\Caribu\Mvc\View\Bootstrap\View')
    ->registerController('\Nkey\Caribu\Mvc\Tests\BootstrapTestController')
    ->setDefaults('BootstrapTest');

Application::getInstance()->serve();