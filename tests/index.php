<?php
namespace Nkey\Caribu\Mvc\Tests;

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use Nkey\Caribu\Mvc\Controller\AbstractController;
use Nkey\Caribu\Mvc\Application;
use Nkey\Caribu\Mvc\Controller\Request;
use Nkey\Caribu\Mvc\View\Bootstrap\Controls\Form;
use Nkey\Caribu\Mvc\View\Bootstrap\Controls\TextField;
use Nkey\Caribu\Mvc\View\Bootstrap\Controls\Button;
use Generics\Logger\ExtendedLogger;

/**
 * A test controller for bootstrap addon
 *
 * @author Maik Greubel <greubel@nkey.de>
 *
 *         This file is part of Caribu MVC Bootstrap addon package
 */
class BootstrapTestController extends AbstractController
{

    public function index(Request $request)
    {
        $this->response->addHeader('Last-modified', \DateTime::createFromFormat('U', filemtime(__FILE__))->format(\DateTime::RFC2822));

        echo '<div class="panel panel-default">';
        echo '<div class="panel-body">';
        echo '<h2>Hello Caribu Bootstrap!</h2>';
        echo '<div class="list-group">';
        printf('<a href="%s/formTest" class="list-group-item">Form test</a>', lcfirst($request->getController()));
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function formTest(Request $request)
    {
        $form = new Form('login', sprintf("%s%s/login", $request->getContextPrefix(), $request->getController()));

        $userName = new TextField('username');
        $userName->setLabel('Username');

        $password = new TextField('password');
        $password->setLabel('Password')->setType('password');

        $login = new Button('login');
        $login->setLabel('Login');

        $form->addField($userName)
            ->addField($password)
            ->addButton($login);

        $this->viewParams['form']['login'] = $form;

        echo '<div class="panel panel-default">';
        echo '<div class="panel-body">';
        echo '{form=login}';
        echo '</div>';
        echo '</div>';
    }

    public function login(Request $request)
    {
        if (!$request->getParam('username')) {
            $this->response->addHeader('Location', sprintf("%s%s", $request->getContextPrefix(), $request->getController()));
        }
        echo '<div class="panel panel-default">';
        echo '<div class="panel-body">';
        echo "Welcome {$request->getParam('username')}";
        echo '</div>';
        echo '</div>';
    }
}

Application::getInstance()->registerView('\Nkey\Caribu\Mvc\View\Bootstrap\View')
    ->registerController('\Nkey\Caribu\Mvc\Tests\BootstrapTestController')
    ->setDefaults('BootstrapTest')
    ->setLogger(new ExtendedLogger());

Application::getInstance()->serve();