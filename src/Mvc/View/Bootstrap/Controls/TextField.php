<?php
namespace Nkey\Caribu\Mvc\View\Bootstrap\Controls;

use Nkey\Caribu\Mvc\Controller\Request;
use Nkey\Caribu\Mvc\View\Controls\ControlException;

/**
 * Text field control
 *
 * @author Maik Greubel <greubel@nkey.de>
 *
 *         This file is part of Caribu MVC Bootstrap addon package
 */
class TextField extends Field
{

    /**
     * The placeholder
     *
     * @var string
     */
    private $placeholder;

    /**
     *
     * @return string The placeholder value
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     *
     * @param string $placeholder
     *            The placeholder value
     */
    public function setPlaceholder($placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    /**
     * (non-PHPdoc)
     * @see \Nkey\Caribu\Mvc\View\Control::render()
     */
    public function render(Request $request, $parameters = array())
    {
        $id = $this->getId();
        if(null == $id) {
            throw new ControlException("Form element must have at least an id");
        }

        $name = $this->getName();
        if(null == $name) {
            $name = $id;
        }

        $cssClass = $this->getClass();

        $value = $this->getValue();
        if(null == $value) {
            $value = $request->getParam($name);
        }

        $placeHolder = $this->getPlaceholder();

        $code = sprintf('<div class="form-group">');

        if(!is_null($this->getLabel())) {
            $code .= sprintf('<label for="%s">%s</label>', $this->getId(), $this->getLabel());
        }

        $code .= sprintf(
            '<input type="text" name="%s" id="%s" class="form-control %s" value="%s" placeholder="%s"/>',
            $name,
            $id,
            $cssClass,
            $value,
            $placeHolder
        );

        $code .= sprintf('</div>');

        return $code;
    }
}
