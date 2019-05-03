<?php
namespace Nkey\Caribu\Mvc\View\Bootstrap\Controls\Form;

use Nkey\Caribu\Mvc\Controller\Request;
use Nkey\Caribu\Mvc\View\Bootstrap\Controls\Control;

/**
 * Bootstrap form implementation
 *
 * @author Maik Greubel <greubel@nkey.de>
 *
 *         This file is part of Caribu MVC Bootstrap addon package
 */
class Form extends Control
{

    /**
     * List of fields
     *
     * @var array
     */
    private $fields = array();

    /**
     * List of buttons
     *
     * @var array
     */
    private $buttons = array();

    /**
     * Method of form
     *
     * @var string
     */
    private $method = "POST";

    /**
     * The form action
     *
     * @var string
     */
    private $action;

    /**
     * Create a new form element
     *
     * @param string $id
     *            The id
     */
    public function __construct(string $id = "", string $action = "")
    {
        $this->id = $id;
        $this->action = $action;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Nkey\Caribu\Mvc\View\Control::render()
     */
    public function render(Request $request, $parameters = array()): string
    {
        $code = sprintf('<form action="%s" method="%s" id="%s">', $this->getFormAction($request, $parameters), $this->method, $this->id);

        foreach ($this->fields as $field) {
            assert($field instanceof Field);
            $code .= $field->render($request);
        }

        foreach ($this->buttons as $button) {
            assert($button instanceof Button);
            $code .= $button->render($request);
        }

        $code .= sprintf('</form>');

        return $code;
    }

    /**
     * Get the form action from request and parameters
     *
     * @param Request $request
     *            The origin request
     * @param array $parameters
     *            Optional parameter list
     *
     * @return string The form action
     */
    private function getFormAction(Request $request, $parameters): string
    {
        if ($this->action) {
            return $this->action;
        }
        $formAction = sprintf("%s%s/%s", ! is_null($request->getContextPrefix() && ! empty($request->getContextPrefix())) ? $request->getContextPrefix() : "", is_array($parameters) && isset($parameters['controller']) ? $parameters['controller'] : lcfirst($request->getController()), is_array($parameters) && isset($parameters['action']) ? $parameters['action'] : lcfirst($request->getAction()));

        if (is_array($parameters) && isset($parameters['formAction'])) {
            $formAction = $parameters['formAction'];
        }

        return $formAction;
    }

    /**
     * Returns all registered fields
     *
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * Add a new field
     *
     * @param Control $field
     * @return Form the current form instance
     */
    public function addField(Field $field): Form
    {
        $this->fields[] = $field;
        return $this;
    }

    /**
     * Returns all registered buttons
     *
     * @return array
     */
    public function getButtons(): array
    {
        return $this->buttons;
    }

    /**
     * Add a button to form
     *
     * @param Button $button
     *            the button to add
     * @return Form the current form instance
     */
    public function addButton(Button $button): Form
    {
        $this->buttons[] = $button;
        return $this;
    }

    /**
     * Returns the method to interact with server on submitting the form
     *
     * Result will be one off GET, POST, etc.
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     *
     * @param string $method
     *            The method to interact with the server on submitting the Form
     * @see Form::getMethod()
     * @return Form the current form instance
     */
    public function setMethod(string $method): Form
    {
        $this->method = $method;
        return $this;
    }
}
