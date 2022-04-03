<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace IhorBoiko\Brands\Model\Attribute\Frontend;

use Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend;
use Magento\Framework\DataObject;

class Brand extends AbstractFrontend
{
    public function getValue(DataObject $object)
    {
	    $value = '';
	    $value_id = $object->getData($this->getAttribute()->getAttributeCode());
	    $value_helper = new \IhorBoiko\Brands\Helper\Data();
		$value_array=$value_helper->getFullDataById($value_id);
		
		if(!empty($value_array)) {
			$value=$value_array['name'];
		}
		
		return $value;
	}
}