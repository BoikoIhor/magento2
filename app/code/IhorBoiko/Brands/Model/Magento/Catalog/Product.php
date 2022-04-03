<?php

namespace IhorBoiko\Brands\Model\Magento\Catalog;


class Product extends \Magento\Catalog\Model\Product
{
	public function getName()
    {
        return parent::getName().' '.date('H:i:s');
    }
	 public function GetDataBrand() {
		   $brand_helper=new \IhorBoiko\Brands\Helper\Data();
		   $brand_array=$brand_helper->getFullDataByProduct($this);
	       return $brand_array;
	 }
}

