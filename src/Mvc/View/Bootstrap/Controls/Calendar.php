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
class Calendar extends Control
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
                $str .= ",\n\t\t";
            }
            $str .= sprintf("%s: %s", $name, $value);
        }
        return $str;
    }

    /**
     * Check whether the given language by request is valid
     *
     * @param string $lang The language
     * @return boolean true in case of it is valid, false otherwise
     */
    private function isValidLanguage($lang)
    {
        $valid = false;
        switch($lang) {
            case 'bs-BA':
            case 'cs-CZ':
            case 'da-DK':
            case 'de-AT':
            case 'de-DE':
            case 'el-GR':
            case 'es-ES':
            case 'es-MX':
            case 'fi-FI':
            case 'fr-FR':
            case 'hr-HR':
            case 'it-IT':
            case 'ja-JP':
            case 'ko-KR':
            case 'nl-NL':
            case 'no-NO':
            case 'pl-PL':
            case 'pt-BR':
            case 'ro-RO':
            case 'ru-RU':
            case 'sl-SL':
            case 'sv-SE':
            case 'tr-TR':
            case 'zh-CN':
                $valid = true;
                break;
            default:
                $valid = false;
                break;
        }
        return $valid;
    }

    /**
     * Set the default parameters
     *
     * @param Request $request
     */
    private function setDefaults(Request $request)
    {
        if ($this->isValidLanguage($request->getParam('Accept-Language-Best'))) {
            $this->options['language'] = sprintf("'%s'", $request->getParam('Accept-Language-Best'));
        }
        $this->options['tmpl_path'] = sprintf("'%s../vendor/serhioromano/bootstrap-calendar/tmpls/'", $request->getContextPrefix());
        if (!isset($this->options['view'])) {
            $this->options['view'] = "'month'";
        }
        if (!isset($this->options['tmpl_cache'])) {
            $this->options['tmpl_cache'] = "false";
        }
        if (!isset($this->options['day'])) {
            $this->options['day'] = sprintf("'%s'", strftime("%Y-%m-%d", time()));
        }
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
        $this->setDefaults($request);

        $html = '
    <div id="'.$this->getId().'"></div>
    <script type="text/javascript">
        "use strict";
        try
        {
            var options = {
                '.$this->optionsToString($this->options).'
            };
            var calendar = $("#'.$this->getId().'").calendar(options);
        }
        catch(e)
        {
            console.error(e);
            console.log(e.stack);
        }
    </script>
    ';
       return $html;
    }
}