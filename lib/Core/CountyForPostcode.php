<?php

namespace CompaniesHouse\Core;

/**
 * countyForPostcode
 *
 * @todo Not sure that this is used
 *
 * @author Someone <someone@somewhere.co.uk>
 */
class CountyForPostcode
{

    public function getCouncil($postcode)
    {

        $postcode = str_replace(" ", "", $postcode);

        $url = "http://www.uk-postcodes.com/postcode/" . urlencode($postcode) . ".json"; // Build the URL

        $file = file_get_contents($url);

        return json_decode($file, true);
    }
}
