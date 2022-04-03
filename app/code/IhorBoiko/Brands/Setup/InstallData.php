<?php

namespace IhorBoiko\Brands\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;

class InstallData implements InstallDataInterface
{   
	private $eavSetupFactory;

	public function __construct(EavSetupFactory $eavSetupFactory)
	{
		$this->eavSetupFactory = $eavSetupFactory;
	}
	
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
	    $this->helper_data=new \IhorBoiko\Brands\Helper\Data();
	    $this->installer=$setup;
	    
	    //$this->SetDatabase();
	    $this->SetAttribute();
    }
    
    
    public function SetAttribute() {
		$eavSetup = $this->eavSetupFactory->create();
		
		//only for quick replace atribute, remove in prod!!!
		if($eavSetup->getAttributeId($this->helper_data->atribute['parent_object'], $this->helper_data->atribute['name'])) {
	         $eavSetup->removeAttribute($this->helper_data->atribute['parent_object'], $this->helper_data->atribute['name']);
	    }
	    //end to remove!!
	    
        $eavSetup->addAttribute($this->helper_data->atribute['parent_object'], $this->helper_data->atribute['name'], $this->helper_data->atribute['option']);
	    
    }
    
    public function SetDatabase() {
	    $helper_data=new \IhorBoiko\Brands\Helper\Data();
	    
	    if (! $this->installer->tableExists($this->helper_data->table_name)) {
			$table =  $this->installer->getConnection()->newTable(
				$this->installer->getTable($this->helper_data->table_name)
			);
			foreach($this->helper_data->table_fields as $name => $field) {
				$table->addColumn($name, $field['type'], $field['length'], $field['option']);
			}				
			 $this->installer->getConnection()->createTable($table);
		}
    }

}