<?php
namespace Nkey\Caribu\Mvc\View\Bootstrap\Controls;

use Nkey\Caribu\Mvc\Controller\Request;

class Div extends Control
{
    /**
     * @var array
     */
    private $elements;

    /**
     * Add a new element to div
     *
     * @param Control $element The element to add
     * @param number $order The order - if not given, the element will be simply appended to end
     *
     * @return Div the current div instance as fluent interface
     */
    public function addElement(Control $element, $order = 0)
    {
        if ($order == 0) {
            $this->elements[] = $element;
        }
        else {
            $this->elements[$order] = $element;
        }
        return $this;
    }

    /**
     * Render all elements
     *
     * @param Request $request The request
     * @param array $parameters Additional parameters to use for rendering
     *
     * @return string The rendered elements
     */
    private function renderElements(Request $request, $parameters = array())
    {
        $elementsRendered = "";
        foreach ($this->elements as $element) {
            $elementsRendered .= sprintf('<div>%s</div>', $element->render($request, $parameters));
        }
        return $elementsRendered;
    }

    /**
     * (non-PHPdoc)
     * @see \Nkey\Caribu\Mvc\View\Control::render()
     */
    public function render(Request $request, $parameters = array())
    {
        $html = sprintf("<div%s%s>%s</div>",
            ($this->getId() != null ? sprintf(' id="%s"', $this->getId()) : ''),
            ($this->getClass() != null ? sprintf(' class="%s"', $this->getClass()) : ''),
            $this->renderElements($request, $parameters));
        return $html;
    }
}