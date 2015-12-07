<?php

/*
 * This file is part of the RequestLab package.
 *
 * (c) RequestLab <hello@requestlab.fr>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace RequestLab\XitiAnalytics;

/**
 * Xiti analytics Query.
 *
 * @author ylcdx <yann@requestlab.fr>
 */
class Response
{
    /**
     * @var array
     */
    protected $columns = array();

    /**
     * @var array
     */
    protected $rows = array();

    /**
     * @var array
     */
    protected $totals = array();

    /**
     * @param array $response
     */
    function __construct(array $response)
    {
        $dataFeed = array();

        if (isset($response['DataFeed'])) {
            $dataFeed = $response['DataFeed'];
        }

        foreach ($dataFeed as $data) {
            if (isset($data['Columns'])) {
                $this->columns = $data['Columns'];
            }
            if (isset($data['Rows'])) {
                $this->rows = $data['Rows'];
            }
            if (isset($data['Totals'])) {
                $this->totals = $data['Totals'];
            }
        }

    }

    /**
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @param array $columns
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;
    }

    /**
     * @return array
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * @param array $rows
     */
    public function setRows($rows)
    {
        $this->rows = $rows;
    }

    /**
     * @return bool
     */
    public function hasRows()
    {
        return !empty($this->rows);
    }

    public function hasTotals()
    {
        return !empty($this->totals);
    }

    /**
     * @return array
     */
    public function getTotals()
    {
        if (!$this->hasTotals()) {

            foreach ($this->getColumns() as $columns) {
                if ($columns['Type'] == 'Integer') {
                    $this->totals[$columns['Name']] = 0;
                }
            }

            foreach ($this->getRows() as $row) {
                foreach ($row as $key => $value) {
                    if (array_key_exists($key, $this->totals)) {
                        $this->totals[$key] = $this->totals[$key] + $value;
                    }
                }
            }
        }

        return $this->totals;
    }

    /**
     * @param array $totals
     */
    public function setTotals($totals)
    {
        $this->totals = $totals;
    }

}