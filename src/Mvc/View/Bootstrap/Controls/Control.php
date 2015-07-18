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
     * @param string $id The id of div
     * @param string $class The name of css class(es)
     */
    public function __construct($id = null, $class = null)
    {
        $this->id = $id;
        $this->class = $class;
    }

    /**
     * @return string The css class
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     *
     * @param string $class The css class
     */
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    /**
     * @return string The id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id The id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

}