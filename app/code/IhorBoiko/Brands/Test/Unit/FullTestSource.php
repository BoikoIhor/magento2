<?php
namespace IhorBoiko\Brands\Test\Unit;
use IhorBoiko\Brands\Model\Attribute\Source\Brand;
use Magento\TestFramework\ObjectManager;
class FullTestSource extends \PHPUnit\Framework\TestCase
{
    protected $sampleClass;
	
	protected $expectedMessage;
 
    public function setUp(): void
    {
		$_SERVER['DOCUMENT_ROOT']='/app';
	    $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $this->sampleClass = $objectManager->getObject('IhorBoiko\Brands\Model\Attribute\Source\Brand');
    }
 
	public function testOptions(): void
    {
        $this->assertIsArray($this->sampleClass->getAllOptions(), 'Recieved vendor options is array or not');
    }
}