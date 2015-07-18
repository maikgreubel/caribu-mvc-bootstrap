<?php
namespace Nkey\Caribu\Mvc\View\Bootstrap\Controls\Form;

use Nkey\Caribu\Mvc\View\Bootstrap\Controls\Control;

/**
 * Abstract form element
 *
 * @author Maik Greubel <greubel@nkey.de>
 *
 *         This file is part of Caribu MVC Bootstrap addon package
 */
abstract class FormElement extends Control
{

    /**
     * Id of element
     *
     * @var string
     */
    private $id;

    /**
     * Name of element
     *
     * @var string
     */
    private $name;

    /**
     * Label of element
     *
     * @var string
     */
    private $label;

    /**
     * The css class(es) of element
     *
     * @var string
     */
    private $class;

    /**
     * The element value
     *
     * @var string
     */
    private $value;

    /**
     * Create a new form element
     *
     * @param string $id The id of form element
     * @param string $name Optional name of element (if not provide, id will be used instead)
     */
    public function __construct($id, $name = null)
    {
        $this->id = $id;
        $this->name = !is_null($name) ? $name : $id;
    }

    /**
     *
     * @return string The id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param string $id
     *            The id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     *
     * @return string The name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * @param string $name
     *            The name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     *
     * @return string The label
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     *
     * @param string $label
     *            The label
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     *
     * @return string The css class(es)
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     *
     * @param string $class
     *            The css class(es)
     */
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    /**
     *
     * @return string The element value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     *
     * @param string $value
     *            The element value
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}