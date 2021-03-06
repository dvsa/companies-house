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

namespace CompaniesHouse;

use CompaniesHouse\Core;

/**
 * CHXmlGateway
 *
 * @package chxmlgateway
 * @version $id$
 * @copyright 2009 Peter Reisinger
 * @author Peter Reisinger <p.reisinger@gmail.com>
 * @license GNU General Public License
 */
class CHXmlGateway
{
    // --- start editing here --- //

    /**
     * password
     *
     * password from companies house
     *
     * @var string
     * @access private
     */
    private $password = 'XMLGatewayTestPassword';   // change

    /**
     * senderID
     *
     * sender id from companies house
     *
     * @var string
     * @access private
     */
    private $senderID = 'XMLGatewayTestUserID';   // change

    /**
     * emailAddress
     *
     * your email address
     * or set to null
     *
     * @var string
     * @access private
     */
    private $emailAddress = null; // set to your email or leave null

    /**
     * Proxy URL
     *
     * Address of proxy to use
     * or set to null for no proxy
     *
     * @var string
     * @access private
     */
    private $proxyUrl = null; // set to your proxy or leave null

    // --- you can stop editing here --- //

    /**
     * getNameSearch
     *
     * @access public
     * @return NameSearch
     */
    public function getNameSearch($companyName, $dataSet)
    {
        return new Core\NameSearch($companyName, $dataSet);
    }

    /**
     * getNumberSearch
     *
     * @param string $partialCompanyNumber
     * @param array $dataSet
     * @access public
     * @return void
     */
    public function getNumberSearch($partialCompanyNumber, array $dataSet)
    {
        return new Core\NumberSearch($partialCompanyNumber, $dataSet);
    }

    /**
     * getCompanyDetails
     *
     * @param strin $companyNumber
     * @access public
     * @return void
     */
    public function getCompanyDetails($companyNumber)
    {
        return new Core\CompanyDetails($companyNumber);
    }

    public function getCompanyAppointments($companyNumber)
    {
        return new Core\CompanyAppointments($companyNumber);
    }

    public function getDocumentInfo($companyNumber)
    {
        return new Core\DocumentInfo($companyNumber);
    }

    public function getDocument($companyNumber)
    {
        return new Core\Document($companyNumber);
    }

    /**
     * getMortgages
     *
     * @param string $companyNumber
     * @param string $companyName
     * @access public
     * @return void
     */
    public function getMortgages($companyNumber, $companyName)
    {
        return new Core\Mortgages($companyNumber, $companyName);
    }

    /**
     * getOfficerSearch
     *
     * @param string $surname
     * @param string $officerType CUR | LLP | DIS | EUR
     * @access public
     * @return void
     */
    public function getOfficerSearch($surname, $officerType)
    {
        return new Core\OfficerSearch($surname, $officerType);
    }

    /**
     * getResponse
     *
     * returns xml response from companies house
     *
     * @param Core\CHRequest $request
     * @access public
     * @return xml
     */
    public function getResponse(Core\CHRequest $request, $transactionID)
    {
        //echo $request->getRequest();
        // --- include Envelope class ---
        // --- create instance of envelope ---
        $envelope = new Core\CHEnvelope(
        $request, $transactionID, $this->senderID, $this->password, $this->emailAddress, $this->proxyUrl
        );

        // --- write into db ---
        //$this->insertInto($request->getClass(), $transID, $request->getData());
        // --- response xml from companies house ---

        $response = $envelope->getResponse();

        // --- check response for error and write into db ---
        //$this->setError($transactionID, $response);
        // --- return response ---
        return $response;
    }

    /**
     * Sets password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Sets sender id
     *
     * @param string $senderID
     */
    public function setUserId($senderID)
    {
        $this->senderID = $senderID;
    }

    /**
     * Sets proxy URL
     *
     * @param string $proxyUrl
     */
    public function setProxyUrl($proxyUrl)
    {
        $this->proxyUrl = $proxyUrl;
    }

    /**
     * Gets proxy URL
     *
     * @param string $proxyUrl
     */
    public function getProxyUrl()
    {
        return $this->proxyUrl;
    }
}
