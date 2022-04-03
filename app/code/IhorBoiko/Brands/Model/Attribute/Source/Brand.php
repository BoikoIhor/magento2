<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace IhorBoiko\Brands\Model\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Brand extends AbstractSource
{
    /**
     * Get all options
     * @return array
     */
 
    public function getAllOptions()
    {
	    if (!$this->_options) {
		    //add empty
		    $this->_options[] = ['label' => __(' '), 'value' => ''];
		    
		    //work with test
			$path=$_SERVER['DOCUMENT_ROOT'].'/app/bootstrap.php';
			$path=str_replace('/pub/', '/', $path);
			require $path;
			
		    $bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $_SERVER);
		    $app = $bootstrap->createApplication('Magento\Framework\App\Http');
		    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		    $objectManager->get('Magento\Framework\App\State')->setAreaCode('frontend');
		    
		    //good work without tests
			//$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
			
			$productCollection = $objectManager->create('\IhorBoiko\Brands\Model\ResourceModel\Brand\Collection');
			$productCollection->addFilter('visibility', 1, 'eq');
			$productCollection->load();
			
			foreach ($productCollection as $product) {
				$product_data = $product->getData();
				
				$this->_options[] = ['label' => __($product_data['name']), 'value' => $product_data['entity_id']];
			}
		}
        return $this->_options;
    }
}