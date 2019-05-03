<?php
namespace Nkey\Caribu\Mvc\View\Bootstrap\Controls;

abstract class Control implements \Nkey\Caribu\Mvc\View\Control
{

    /**
     * The css class
     *
     * @var string
     */
    private $class;

    /**
     * The html id
     *
     * @var string
     */
    private $id;

    /**
     * Create a new Div
     *
     * @param string $id
     *            The id of div
     * @param string $class
     *            The name of css class(es)
     */
    public function __construct(string $id = "", string $class = "")
    {
        $this->id = $id;
        $this->class = $class;
    }

    /**
     *
     * @return string The css class
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     *
     * @param string $class
     *            The css class
     *
     * @return Control the current control instance
     */
    public function setClass(string $class): Control
    {
        $this->class = $class;
        return $this;
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
     */
    public function setId(string $id): Control
    {
        $this->id = $id;
        return $this;
    }
}