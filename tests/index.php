<?php
namespace Nkey\Caribu\Mvc\Tests;

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use Nkey\Caribu\Mvc\Controller\AbstractController;
use Nkey\Caribu\Mvc\Application;
use Nkey\Caribu\Mvc\Controller\Request;
use Nkey\Caribu\Mvc\View\Bootstrap\Controls\Form\Form;
use Nkey\Caribu\Mvc\View\Bootstrap\Controls\Form\TextField;
use Nkey\Caribu\Mvc\View\Bootstrap\Controls\Form\Button;
use Generics\Logger\ExtendedLogger;
use Nkey\Caribu\Mvc\View\Bootstrap\Controls\Calendar;
use Nkey\Caribu\Mvc\View\Bootstrap\Controls\Div;
use Nkey\Caribu\Mvc\View\Bootstrap\Controls\Form\DatePicker;
use Nkey\Caribu\Mvc\View\Bootstrap\Controls\Table;

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
        printf('<a href="%s/calendar" class="list-group-item">Calendar test</a>', lcfirst($request->getController()));
        printf('<a href="%s/datePicker" class="list-group-item">Date picker test</a>', lcfirst($request->getController()));
        printf('<a href="%s/table" class="list-group-item">Table test</a>', lcfirst($request->getController()));
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function formTest(Request $request)
    {
        $form = new Form('login', sprintf("%s%s/login", $request->getContextPrefix(), lcfirst($request->getController())));

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
            $this->response->addHeader('Location', sprintf("%s%s", $request->getContextPrefix(), lcfirst($request->getController())));
        }
        echo '<div class="panel panel-default">';
        echo '<div class="panel-body">';
        echo "Welcome {$request->getParam('username')}";
        echo '</div>';
        echo '</div>';
    }

    public function calendar(Request $request)
    {
        $main = new Div('main');
        $calendar = new Calendar('calendar');
        $calendar->setOption('events_source', sprintf("'%s%s/events'", $request->getContextPrefix(), lcfirst($request->getController())));

        $main->addElement($calendar);
        $this->viewParams['div']['main'] = $main;

        echo '<div class="panel panel-default">';
        echo '<div class="panel-body">';
        echo '{div=main}';
        echo '</div>';
        echo '</div>';
    }

    public function events(Request $request)
    {
        $event = array(
            'id' => 1,
            'title' => 'Just some test event',
            'url' => sprintf("%s%s/event/1", $request->getContextPrefix(), lcfirst($request->getController())),
            'start' => time() * 1000,
            'end' => (time() + 86400) * 1000
        );

        $events['result'][] = $event;
        $events['success'] = true;

        $this->response->setType('application/json');
        $this->response->setBody(json_encode($events));
    }

    public function datePicker(Request $request)
    {
        $form = new Form('datepicker', sprintf("%s%s/datepicker", $request->getContextPrefix(), lcfirst($request->getController())));

        $datePicker = new DatePicker('startDate');
        $datePicker->setLabel('Day');
        $form->addField($datePicker);

        $this->viewParams['form']['datepicker'] = $form;

        echo '<div class="panel panel-default">';
        echo '<div class="panel-body">';
        echo '{form=datepicker}';
        echo '</div>';
        echo '</div>';

    }

    /**
     * @webMethod
     */
    public function table()
    {
        $table = new Table();
        $table->addColumnHeader('#')->addColumnHeader('First name')->addColumnHeader('Last name')->addColumnHeader('Email');

        $table->addRow(array(
            1,
            'Joe',
            'Tester',
            'joe@test.tld'
        ))->addRow(array(
            2,
            'Jane',
            'Doe',
            'jane@doe.tld'
        ))->addRow(array(
            45,
            'Hank',
            'Wolli',
            'hank@wolli.tld'
        ));

        $this->viewParams['table']['users'] = $table;

        echo '<div class="panel panel-default">';
        echo '<div class="panel-body">';
        echo '{table=users}';
        echo '</div>';
        echo '</div>';

    }
}

Application::getInstance()->registerView('\Nkey\Caribu\Mvc\View\Bootstrap\View')
    ->registerController('\Nkey\Caribu\Mvc\Tests\BootstrapTestController')
    ->setDefaults('BootstrapTest')
    ->addHeader('Content-Type', 'text/html; charset=utf-8')
    ->setLogger(new ExtendedLogger());

Application::getInstance()->serve();