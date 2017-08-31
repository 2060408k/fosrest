<?php
/**
 * Created by PhpStorm.
 * User: pkourtellos
 * Date: 17/08/2017
 * Time: 11:22
 */

namespace AppBundle\Service;

use AppBundle\Entity\Character;

class JsonFormatter {

	/**
	 * @param array $input
	 *
	 * @return string
	 */
	public function toJson( $input)
	{
		$output = [];

		foreach($input as $element)
		{
		    if(method_exists($element,'expose')){
                $output[]=$element->expose();
            }

		}

		return json_encode($output);
	}
}