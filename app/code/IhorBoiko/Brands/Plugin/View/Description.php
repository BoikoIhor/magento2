<?php
namespace IhorBoiko\Brands\Plugin\View;
use IhorBoiko\Brands\Model\BrandFactory;
use IhorBoiko\Brands\Helper\Data;

class Description {
    public $modelBrandFactory;

    public function __construct(
        \IhorBoiko\Brands\Model\BrandFactory $modelBrandFactory
    ) {
        $this->modelBrandFactory = $modelBrandFactory;
    }

	 public function beforeToHtml(\Magento\Catalog\Block\Product\View\Description $originalBlock)
	 {
        if($originalBlock->getNameInLayout()=='product.info.sku')
	 	{
	 	    $helper=new Data();
            $helper->getCorrectBrand($this, $originalBlock);
            $originalBlock->setTemplate('IhorBoiko_Brands::product/view/brands.phtml');
	 	}
	 }
}