<?php
namespace Nkey\Caribu\Mvc\View\Bootstrap\Controls;

class Span extends Control
{
    /**
     * The span content
     *
     * @var string
     */
    private $content;

    /**
     *
     * @return the string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     *
     * @param
     *            $content
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }



}