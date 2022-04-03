<?php
namespace IhorBoiko\Brands\Test\Unit;
use IhorBoiko\Brands\Helper\Data;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
class FullTestHelper extends \PHPUnit\Framework\TestCase
{

    protected $sampleClass;
 
    public function setUp(): void
    {
	    $_SERVER['DOCUMENT_ROOT']='/app';
	    
	    $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $this->sampleClass = $objectManager->getObject('IhorBoiko\Brands\Helper\Data');
        
        //test DB
        $this->expected['tablename'] = 'brand_list';
        
        //test atribute
        $this->expected['atribute_code']='brand_selector_2';
        $this->expected['atribute_array'] = array(
           	'parent_object'=>\Magento\Catalog\Model\Product::ENTITY,
            'name'=>$this->expected['atribute_code'],
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
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'visible' => true,
                'is_html_allowed_on_front' => true,
                'visible_on_front' => true
            ]
        );
        
        //test show active vendors
        $this->expected['product_id'] = 1;

    }
 
	public function testShowVendorFromProductId(): void
    {
        $this->assertIsArray($this->sampleClass->getBrandByProductId($this->expected['product_id']), 'Recieved vendor is array or not');
    }

    public function testAtributeCode(): void
    {
        $this->assertEquals($this->expected['atribute_code'], $this->sampleClass->getAtributeName());
    }
 
    public function testTableName(): void
    {
        $this->assertEquals($this->expected['tablename'], $this->sampleClass->getTableName());
    }
    
    public function testAtributeArray(): void
    {
        $this->assertEqualsCanonicalizing($this->expected['atribute_array'], $this->sampleClass->getAtributeData());
    }
}