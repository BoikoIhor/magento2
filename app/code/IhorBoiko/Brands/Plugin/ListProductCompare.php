<?php
namespace IhorBoiko\Brands\Plugin;

use IhorBoiko\Brands\Model\BrandFactory;
use IhorBoiko\Brands\Helper\Data;

class ListProductCompare {
    public $modelBrandFactory;

    public function __construct(
        \IhorBoiko\Brands\Model\BrandFactory $modelBrandFactory
    ) {
        $this->modelBrandFactory = $modelBrandFactory;
    }


    public function beforeToHtml(\Magento\Catalog\Block\Product\ProductList\Item\AddTo\Compare $originalBlock)
    {

        $helper=new Data();
        $helper->getCorrectBrand($this, $originalBlock);

       $originalBlock->setTemplate('IhorBoiko_Brands::product/brands.phtml');
    }
}