<?php

/*
  +-------------------------------------------------------------------------------+
  |   Copyright 2009 Peter Reisinger - p.reisinger@gmail.com                      |
  |                                                                               |
  |   This program is free software: you can redistribute it and/or modify        |
  |   it under the terms of the GNU General Public License as published by        |
  |   the Free Software Foundation, either version 3 of the License, or           |
  |   (at your option) any later version.                                         |
  |                                                                               |
  |   This program is distributed in the hope that it will be useful,             |
  |   but WITHOUT ANY WARRANTY; without even the implied warranty of              |
  |   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               |
  |   GNU General Public License for more details.                                |
  |                                                                               |
  |   You should have received a copy of the GNU General Public License           |
  |   along with this program.  If not, see <http://www.gnu.org/licenses/>.       |
  +-------------------------------------------------------------------------------+
 */

namespace CompaniesHouse\Core;

use Zend\Http\Response;
use Olcs\Db\Exceptions\RestResponseException;

/**
 * CompanyDetails
 *
 * @uses CHRequest
 * @package chxmlgateway
 * @version $id$
 * @copyright 2009 Peter Reisinger
 * @author Peter Reisinger <p.reisinger@gmail.com>
 * @license GNU General Public License
 */
class CompanyAppointments implements CHRequest
{

    /**
     * xml template file
     */
    const COMPANY_APPOINTMENTS_FILE = "/xml/companyApptRequest.xml";

    /**
     * class
     *
     * class tag in the envelope
     *
     * @var string
     * @access private
     */
    private $class = 'CompanyAppointments';

    /**
     * data
     *
     * holds values set by user - to be
     * sent in the request
     *
     * @var array
     * @access private
     */
    private $data = array();

    /**
     * __construct
     *
     * @param string $partialCompanyNumber
     * @param array $dataSet
     * @access public
     * @return void
     */
    public function __construct($companyNumber)
    {
        $companyNumber = trim($companyNumber);

        $pattern = '/^[A-Z0-9]{8}$/';

        if (!preg_match($pattern, $companyNumber)) {
            throw new RestResponseException(
                'Company number has to be in this pattern: ' . $pattern, Response::STATUS_CODE_500
            );
        }
        $this->data['companyNumber'] = $companyNumber;
    }

    /**
     * getClass
     *
     * @access public
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * getData
     *
     * contains all data set by user
     *
     * @access public
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * getRequest
     *
     * @access public
     * @return xml
     */
    public function getRequest()
    {
        // load xml file
        $body = simplexml_load_file(dirname(__FILE__) . self::COMPANY_APPOINTMENTS_FILE);

        // fill in compulsory fields
        $body->CompanyNumber = $this->data['companyNumber'];

        // return xml
        return $body->asXML();
    }
}
