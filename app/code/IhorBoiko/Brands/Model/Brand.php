<?php

namespace IhorBoiko\Brands\Model;

class Brand extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    /**
     * Initialize resource model
     *
     * @return void
     */
     
    const CACHE_TAG = 'ihorboiko_brands_brand';

	protected $_cacheTag = 'ihorboiko_brands_brand';

	protected $_eventPrefix = 'ihorboiko_brands_brand';
     
     
    protected function _construct()
    {
        $this->_init('IhorBoiko\Brands\Model\ResourceModel\Brand');
    }
    
    public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}

    public function getList(){
    }
}
?>