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
     * @param string $id
     *            The id of form element
     * @param string $name
     *            Optional name of element (if not provide, id will be used instead)
     */
    public function __construct(string $id, string $name = "")
    {
        $this->id = $id;
        $this->name = $name != "" ? $name : $id;
    }

    /**
     *
     * @return string The id
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     *
     * @param string $id
     *            The id
     *
     * @return FormElement the current form element instance
     */
    public function setId(string $id): FormElement
    {
        $this->id = $id;
        return $this;
    }

    /**
     *
     * @return string The name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     *
     * @param string $name
     *            The name
     *
     * @return FormElement the current form element instance
     */
    public function setName(string $name): FormElement
    {
        $this->name = $name;
        return $this;
    }

    /**
     *
     * @return string The label
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     *
     * @param string $label
     *            The label
     *
     * @return FormElement the current form element instance
     */
    public function setLabel(string $label): FormElement
    {
        $this->label = $label;
        return $this;
    }

    /**
     *
     * @return string The css class(es)
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     *
     * @param string $class
     *            The css class(es)
     * @return FormElement the current form element instance
     */
    public function setClass(string $class): FormElement
    {
        $this->class = $class;
        return $this;
    }

    /**
     *
     * @return string The element value
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     *
     * @param string $value
     *            The element value
     * @return FormElement the current form element instance
     */
    public function setValue(string $value): FormElement
    {
        $this->value = $value;
        return $this;
    }
}