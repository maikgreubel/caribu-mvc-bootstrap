<?php
namespace Nkey\Caribu\Mvc\View\Bootstrap\Controls\Form;

use Nkey\Caribu\Mvc\Controller\Request;
use Nkey\Caribu\Mvc\View\Controls\ControlException;

/**
 * This class is part of the Caribu MVC Bootstrap addon package
 *
 * @author Maik Greubel <greubel@nkey.de>
 */
class DatePicker extends TextField
{
    /**
     * Options to add to constructor
     *
     * @var array
     */
    private $options = array();

    /**
     * List of events to override
     *
     * @var array
     */
    private $events = array();

    /**
     * Add an option to the datepicker
     *
     * @param string $name The name of the option
     * @param mixed $value The value of the option
     *
     * @return DatePicker the current datepicker instance
     */
    public function addOption($name, $value)
    {
        $this->options[$name] = $value;
        return $this;
    }

    /**
     * Dependending on type the value will be wrapped by quotes or not
     *
     * @param mixed $value The value to wrap
     *
     * @return string the wrapped value
     */
    private function valueToString($value)
    {
        $result = strval($value);
        if(is_string($value)) {
            $result = sprintf("'%s'", $value);
        }
        return $result;
    }

    /**
     * Generate javascript options for the datepicker
     *
     * @return string The options as javascript code
     */
    private function getOptionsString()
    {
        $code = "";

        foreach ($this->options as $name => $value) {
            $code .= sprintf('%s%s: %s', ($code ? ',' : ''), $name, $this->valueToString($value))."\n";
        }

        return $code;
    }

    /**
     * Generate javascript code for the events
     *
     * @return string The javascript code
     */
    private function eventsToString()
    {
        $code = "";
        foreach ($this->events as $event => $code) {
            $code .= sprintf(".on('%s', function(e) { %s })", $event, $code);
        }
        return $code;
    }

    /**
     * Add an event handler
     *
     * @param string $on The event to add a handler code for
     * @param string $code The javascript code, which will be embedded into handler function
     *
     * @throws ControlException
     */
    public function addEvent($on, $code)
    {
        switch($on) {
            case 'show':
            case 'hide':
            case 'clearDate':
            case 'changeDate':
            case 'changeYear':
            case 'changeMonth':
                $this->events[$on] = $code;
                break;
            default:
                throw new ControlException("Can not override non existing event {ev}", array('ev' => $on));
        }

    }

    /**
     * (non-PHPdoc)
     * @see \Nkey\Caribu\Mvc\View\Bootstrap\Controls\Form\TextField::render()
     */
    public function render(Request $request, $parameters = array())
    {
        $this->setClass( sprintf("%s datapicker", $this->getClass()) );
        if (!$this->hasElementParameter('data-date-format')) {
            $this->addParameter('data-date-format', "yyyy-mm-dd");
        }
        if (!$this->getValue()) {
            $this->setValue(strftime("%Y-%m-%d"));
        }

        $code = sprintf('%s
            <script type="text/javascript">
            $("#%s").datepicker({
                '.$this->getOptionsString().'
            })'.$this->eventsToString().';
            </script>',
            parent::render($request, $parameters),
            $this->getId());

        return $code;
    }
}