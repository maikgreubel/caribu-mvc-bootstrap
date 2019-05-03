<?php
namespace Nkey\Caribu\Mvc\View\Bootstrap\Controls\Form;

use Nkey\Caribu\Mvc\Controller\Request;

/**
 * Button control
 *
 * @author Maik Greubel <greubel@nkey.de>
 *
 *         This file is part of Caribu MVC Bootstrap addon package
 */
class Button extends FormElement
{

    /**
     * The type of button
     *
     * @var string
     */
    private $type;

    /**
     *
     * @return string The type
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     *
     * @param string $type
     *            The type
     */
    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Nkey\Caribu\Mvc\View\Control::render()
     */
    public function render(Request $request, $parameters = array()): string
    {
        $code = sprintf('<button type="%s" id="%s" class="btn btn-default %s" name="%s">%s</button>', //
        (! is_null($this->type) ? $this->type : "submit"), //
        $this->getId(), //
        $this->getClass(), //
        $this->getName(), //
        is_null($this->getLabel()) ? $this->getName() : $this->getLabel());

        return $code;
    }
}
