<?php
/**
 * PHPUnit
 *
 * Copyright (c) 2002-2014, Sebastian Bergmann <sebastian@phpunit.de>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Sebastian Bergmann nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    DbUnit
 * @author     Mike Lively <m@digitalsandwich.com>
 * @copyright  2002-2014 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://www.phpunit.de/
 * @since      File available since Release 1.0.0
 */

/**
 * Provides default table functionality.
 *
 * @package    DbUnit
 * @author     Mike Lively <m@digitalsandwich.com>
 * @copyright  2010-2014 Mike Lively <m@digitalsandwich.com>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @version    Release: 1.3.1
 * @link       http://www.phpunit.de/
 * @since      Class available since Release 1.0.0
 */
class PHPUnit_Extensions_Database_DataSet_DefaultTable extends PHPUnit_Extensions_Database_DataSet_AbstractTable
{

    /**
     * Creates a new table object using the given $tableMetaData
     *
     * @param PHPUnit_Extensions_Database_DataSet_ITableMetaData $tableMetaData
     */
    public function __construct(PHPUnit_Extensions_Database_DataSet_ITableMetaData $tableMetaData)
    {
        $this->setTableMetaData($tableMetaData);
        $this->data = array();
    }

    /**
     * Adds a row to the table with optional values.
     *
     * @param array $values
     */
    public function addRow($values = array())
    {
        $this->data[] = array_merge(
          array_fill_keys($this->getTableMetaData()->getColumns(), NULL),
          $values
        );
    }

    /**
     * Adds the rows in the passed table to the current table.
     *
     * @param PHPUnit_Extensions_Database_DataSet_ITable $table
     */
    public function addTableRows(PHPUnit_Extensions_Database_DataSet_ITable $table)
    {
        $tableColumns = $this->getTableMetaData()->getColumns();
        $rowCount     = $table->getRowCount();

        for ($i = 0; $i < $rowCount; $i++) {
            $newRow = array();
            foreach ($tableColumns as $columnName) {
                $newRow[$columnName] = $table->getValue($i, $columnName);
            }
            $this->addRow($newRow);
        }
    }

    /**
     * Sets the specified column of the specied row to the specified value.
     *
     * @param int $row
     * @param string $column
     * @param mixed $value
     */
    public function setValue($row, $column, $value)
    {
        if (isset($this->data[$row])) {
            $this->data[$row][$column] = $value;
        } else {
            throw new InvalidArgumentException("The row given does not exist.");
        }
    }
}
