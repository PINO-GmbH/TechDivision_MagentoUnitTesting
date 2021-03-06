<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 */

/**
 * Abstract test case for default models
 *
 * @category   TechDivision
 * @package    TechDivision_MagentoUnitTesting
 * @subpackage TestCase
 * @copyright  Copyright (c) 1996-2014 TechDivision GmbH (http://www.techdivision.com)
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @version    ${release.version}
 * @since      Class available since Release 0.1.0
 * @author     Vadim Justus <v.justus@techdivision.com>
 */
class TechDivision_MagentoUnitTesting_TestCase_Model
    extends TechDivision_MagentoUnitTesting_TestCase_Abstract
{
    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     */
    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Init the class we want test. Reflection is used for calling the constructur, so that it is
     * possible to use an array supplying the constructor arguments.
     *
     * @return void
     */
    protected function _initInstance()
    {
        $testClass       = $this->_testClassName;
        $this->_instance = new $testClass($this->_testClassInitArguments);
    }

}