<?php
namespace Nkey\Caribu\Mvc\View\Bootstrap\Controls;

use Nkey\Caribu\Mvc\Controller\Request;

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
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     *
     * @param
     *            $content
     */
    public function setContent(string $content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Nkey\Caribu\Mvc\View\Control::render()
     */
    public function render(Request $request, $parameters = array())
    {
        $html = sprintf("<span%s%s>%s</span>", //
        ($this->getId() != null ? sprintf(' id="%s"', $this->getId()) : ''), //
        ($this->getClass() != null ? sprintf(' class="%s"', $this->getClass()) : ''), //
        $this->content);
        return $html;
    }
}