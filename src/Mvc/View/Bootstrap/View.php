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

    /**
     * List of css files to include
     *
     * @var array
     */
    private $cssFiles = array();

    /**
     * List of javascript files to include
     * @var unknown
     */
    private $jsFiles = array();

    public function __construct()
    {
        $this->registerControl('Nkey\Caribu\Mvc\View\Bootstrap\Controls\Form\Form', 'form');
        $this->registerControl('Nkey\Caribu\Mvc\View\Bootstrap\Controls\Div', 'div');
        $this->registerControl('Nkey\Caribu\Mvc\View\Bootstrap\Controls\Span', 'span');
        $this->registerControl('Nkey\Caribu\Mvc\View\Bootstrap\Controls\Table', 'table');
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
     * Get all additional css files as link html code
     * @return string
     */
    private function getAdditionalCssFiles()
    {
        $code = "";
        foreach ($this->getCssFiles() as $file) {
            $code .= sprintf('<link type="text/css" rel="stylesheet" href="%s"/>', $file) . "\n";
        }
        return $code;
    }

    /**
     * Get all additional javascript files as script html code
     * @return string
     */
    private function getAdditionalJsFiles()
    {
        $code = "";
        foreach ($this->getJsFiles() as $file) {
            $code .= sprintf('<script type="text/javascript" src="%s"></script>', $file) . "\n";
        }
        return $code;
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

    <link rel="stylesheet" href="'.sprintf("%s../components/bootstrap/css/bootstrap.min.css", $request->getContextPrefix()).'">
    <link rel="stylesheet" href="'.sprintf("%s../components/bootstrap/css/bootstrap-theme.min.css", $request->getContextPrefix()).'">
    <link rel="stylesheet" href="'.sprintf("%s../components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css", $request->getContextPrefix()).'">
    <link rel="stylesheet" href="'.sprintf("%s../vendor/serhioromano/bootstrap-calendar/css/calendar.min.css", $request->getContextPrefix()).'">
    '.$this->getAdditionalCssFiles().'

    <script src="'.sprintf("%s../components/jquery/jquery.min.js", $request->getContextPrefix()).'"></script>
    <script src="'.sprintf("%s../components/bootstrap/js/bootstrap.min.js", $request->getContextPrefix()).'"></script>
    <script src="'.sprintf("%s../components/bootstrap-datepicker/js/bootstrap-datepicker.js", $request->getContextPrefix()).'"></script>
    <script src="'.sprintf("%s../components/underscore/underscore-min.js", $request->getContextPrefix()).'"></script>
    '.(null !== $request->getParam('Accept-Language-Best') ?
        sprintf('<script src="%s../vendor/serhioromano/bootstrap-calendar/js/language/%s.js"></script>',
            $request->getContextPrefix(), $request->getParam('Accept-Language-Best')) :
    '').'
    <script src="'.sprintf("%s../vendor/serhioromano/bootstrap-calendar/js/calendar.min.js", $request->getContextPrefix()).'"></script>
    '.$this->getAdditionalJsFiles().'
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