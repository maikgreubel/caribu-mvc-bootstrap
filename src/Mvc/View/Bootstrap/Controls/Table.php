<?php
namespace Nkey\Caribu\Mvc\View\Bootstrap\Controls;

use Nkey\Caribu\Mvc\Controller\Request;
class Table extends Control
{
    /**
     * Column headers
     *
     * @var array
     */
    private $columnHeaders;

    /**
     * Add a row to the table
     *
     * @var array
     */
    private $rows;

    /**
     * Add a new header
     *
     * @param string $headerName The column header name
     * @param number $order Optional order number
     *
     * @return Table the current table instance as fluent interface
     */
    public function addColumnHeader($headerName, $order = null)
    {
        if(null != $order && is_int($order)) {
            $this->columnHeaders[$order] = $headerName;
        }
        else {
            $this->columnHeaders[count($this->columnHeaders)] = $headerName;
        }
        return $this;
    }

    /**
     * Add a new row to the table
     *
     * @param array $row The row to add
     *
     * @return Table the current table instance as fluent interface
     */
    public function addRow($row)
    {
        $this->rows[] = $row;
        return $this;
    }

    /**
     * (non-PHPdoc)
     * @see \Nkey\Caribu\Mvc\View\Control::render()
     */
    public function render(Request $request, $parameters = array())
    {
        $code = sprintf('<table %sclass=".table%s">', $this->getId() ? sprintf(' id="%s"', $this->getId()) : '',
            $this->getClass() ? sprintf(' %s', $this->getClass()) : "");

        if (count($this->columnHeaders)) {
            $code.= "<tr>";

            foreach ($this->columnHeaders as $header) {
                $code .= sprintf('<th>%s</th>', $header);
            }
            $code.= "</tr>";
        }

        foreach ($this->rows as $row) {
            $code.= "<tr>";
            foreach ($row as $col) {
                $code.= sprintf('<td>%s</td>', $col);
            }
            $code.= "</tr>";
        }

        $code.= "</table>";

        return $code;
    }
}