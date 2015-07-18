<?php
namespace Nkey\Caribu\Mvc\View\Bootstrap\Controls\Form;

use Nkey\Caribu\Mvc\Controller\Request;

class DatePicker extends TextField
{
    /**
     * (non-PHPdoc)
     * @see \Nkey\Caribu\Mvc\View\Bootstrap\Controls\Form\TextField::render()
     */
    public function render(Request $request, $parameters = array())
    {
        $this->setClass( sprintf("%s datapicker", $this->getClass()) );
        $this->addParameter('data-date-format', "yyyy-mm-dd");
        if (!$this->getValue()) {
            $this->setValue(strftime("%Y-%m-%d"));
        }

        $code = sprintf('%s
            <script type="text/javascript">
            $("#%s").datepicker({
                autoclose: true,
                weekStart: 1
            });
            </script>',
            parent::render($request, $parameters),
            $this->getId());

        return $code;
    }
}