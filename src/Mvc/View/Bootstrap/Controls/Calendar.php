<?php

namespace Nkey\Caribu\Mvc\View\Bootstrap\Controls;

use Nkey\Caribu\Mvc\Controller\Request;
/**
 * Calendar control
 *
 * @author Maik Greubel <greubel@nkey.de>
 *
 *         This file is part of Caribu MVC Bootstrap addon package
 */
class Calendar extends Field
{
    private $options = array();

    private function optionsToString(array $options)
    {
        $str = "";

        foreach ($options as $name => $value) {
            if (empty($value)) {
                continue;
            }
            if (!empty($str)) {
                $str .= ', ';
            }
            $str .= sprintf("%s: '%s'", $name, $value);
        }
        return $str;
    }

    /**
     * Set a particular option name to a given value
     *
     * @param string $name
     * @param string $value
     *
     * @return Calendar
     */
    public function setOption($name, $value)
    {
        $this->options[$name] = $value;
        return $this;
    }

    /**
     * (non-PHPdoc)
     * @see \Nkey\Caribu\Mvc\View\Control::render()
     */
    public function render(Request $request, $parameters = array())
    {
        $this->options['language'] = $request->getParam('Accept-Language-Best');
        $this->options['tmpl_path'] = sprintf('%svendor/sehioromano/bootstrap-calendar/tmpls', $request->getContextPrefix());

        $html = '<script type="text/javascript">
    var calendar = $("#'.$this->getId().'").calendar({'.$this->optionsToString($this->options).'});
</script>
<div id="'.$this->getId().'"></div>';
       return $html;
    }
}