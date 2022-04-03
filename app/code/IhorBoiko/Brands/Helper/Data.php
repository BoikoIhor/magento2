<?php

namespace IhorBoiko\Brands\Helper;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    private $_objectManager;

   public function __construct(){
       $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();

       $this->getTableName();
       $this->getAtributeData();
   }

   public static function getAtributeName() {
       return 'brand_selector_2';
   }

   public function getAtributeData()
   {
        $this->atribute=array(
            'parent_object'=>\Magento\Catalog\Model\Product::ENTITY,
            'name'=>$this->getAtributeName(),
            'option'=>[
                'group' => 'General',
                'type' => 'varchar',
                'label' => 'Vendor',
                'input' => 'select',
                'source' => 'IhorBoiko\Brands\Model\Attribute\Source\Brand',
                'frontend' => 'IhorBoiko\Brands\Model\Attribute\Frontend\Brand',
                'backend' => 'IhorBoiko\Brands\Model\Attribute\Backend\Brand',
                'required' => false,
                'sort_order' => 50,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'used_in_product_listing' => true,
                'user_defined'=>true,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'visible' => true,
                'is_html_allowed_on_front' => true,
                'visible_on_front' => true
            ]
        );
        return $this->atribute;
   }

   public function getTableName()
   {
        $this->table_name='brand_list2';
        return $this->table_name;
   }

   public static function FixDocumentRoot($path) {
       $path=str_replace($_SERVER['DOCUMENT_ROOT'], '/', $path);
       return $path;
   }

    function getAbsoluteMediaPath($relativeMediaPath) {
        $filesystem = $this->_objectManager->get('Magento\Framework\Filesystem');
        $reader = $filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $path=$reader->getAbsolutePath($relativeMediaPath);

        return self::FixDocumentRoot($path);
    }

		public function getFullDataById($value_id)
        {
            $brandDatamodel = $this->_objectManager->get('IhorBoiko\Brands\Model\Brand')->getCollection();
            $brandDatamodel->addFieldToFilter('entity_id', array('eq' => $value_id));
            $brandDataArray = $brandDatamodel->getData();
            $brandDataArray = reset($brandDataArray);

            if (!empty($brandDataArray['picture'])) {
                $brandDataArray['picture'] = self::getAbsoluteMediaPath($brandDataArray['picture']);
            }
            return $brandDataArray;
        }
       
       public function getFullDataByProduct(\Magento\Catalog\Model\Product $_product) {
	       $value_id=$_product->getData($this->getAtributeName());
	       return $this->getFullDataById($value_id);
       }

       /*
    public function getFullDataLikeCollection($block) {
        $block->modelBrandFactory
        $value_id=$_product->getData($this->getAtributeName());
        return $this->getFullDataById($value_id);
    }*/

    public function getCorrectBrand($block, &$originalBlock){

        $value_id=$originalBlock->getProduct()->getData($this->getAtributeName());

        if($value_id>0) {
            $brand_factory = $block->modelBrandFactory->create();
            $brand_collection = $brand_factory->getCollection();
            $brand_collection->addFieldToFilter('entity_id', array('eq' => $value_id));
            $brandDataArray = $brand_collection->getData();
            $brandDataArray = reset($brandDataArray);
            if (!empty($brandDataArray['picture'])) {
                $brandDataArray['picture'] = self::getAbsoluteMediaPath($brandDataArray['picture']);
            }

            $originalBlock->setData(['brand' => $brandDataArray]);
        }
    }

}