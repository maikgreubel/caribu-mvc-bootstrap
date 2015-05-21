<?php
namespace Nkey\Caribu\Mvc\View\Bootstrap;

use \Nkey\Caribu\Mvc\Controller\Response;
use \Nkey\Caribu\Mvc\Controller\Request;
use \Nkey\Caribu\Mvc\View\AbstractView;
use \Generics\Util\Interpolator;

/**
 * This class provides a view implementation depending on bootstrap
 *
 * @author Maik Greubel <greubel@nkey.de>
 *         This file is part of Bootstrap addon for Caribu MVC
 */
class View extends AbstractView
{
    use Interpolator;

    public function __construct()
    {
        $this->registerControl('Nkey\Caribu\Mvc\View\Bootstrap\Controls\Form', 'form');
    }

    /**
     * (non-PHPdoc)
     * @see \Nkey\Caribu\Mvc\View\View::getOrder()
     */
    public function getOrder()
    {
        return 1;
    }

    /**
     * (non-PHPdoc)
     * @see \Nkey\Caribu\Mvc\View\View::render()
     */
    public function render(Response &$response, Request $request, $parameters = array())
    {
        if ($response->getType() != 'text/html') {
            return;
        }

        $html = '<!DOCTYPE html>
<html>
<head>
    <title>{title}</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="jumbotron">
		<div class="container">
            {content}
        </div>
    </div>
</body>
</html>';
        $response->setBody($this->interpolate($html, array('title' => $response->getTitle(), 'content' => $response->getBody())));
    }
}