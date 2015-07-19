<?php
namespace Nkey\Caribu\Mvc\View\Bootstrap\Controls\Form;

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
     * Type of text field
     * @var string
     */
    private $type;

    /**
     * The placeholder
     *
     * @var string
     */
    private $placeholder;

    /**
     * Additional element parameters
     * @var array
     */
    private $elementParameters = array();

    /**
     *
     * @return string The placeholder value
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * Add another parameter to element
     *
     * @param string $name The name of parameter
     * @param string $value The value of parameter
     *
     * @return TextField
     */
    public function addParameter($name, $value)
    {
        $this->elementParameters[$name] = $value;
        return $this;
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
     * Retrieve the element parameter as string
     *
     * @return string The element parameters
     */
    private function getElementParameterString()
    {
        $string = "";
        foreach ($this->elementParameters as $name => $value) {
            $string .= sprintf(' %s="%s"', $name, $value);
        }
        return $string;
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
            '<input type="%s" name="%s" id="%s" class="form-control %s" value="%s" placeholder="%s"%s/>',
            $this->type,
            $name,
            $id,
            $cssClass,
            $value,
            $placeHolder,
            $this->getElementParameterString()
        );

        $code .= sprintf('</div>');

        return $code;
    }

    /**
     * Set the text field type
     *
     * @param string $type The type
     */
    public function setType($type = 'text')
    {
        $this->type = $type;
    }

    /**
     * Checks whether a given parameter exists in element parameters
     *
     * @param string $name The name of parameter to check
     *
     * @return boolean true in case of parameter is set, false otherwise
     */
    public function hasElementParameter($name)
    {
        return isset($this->elementParameters[$name]);
    }
}
