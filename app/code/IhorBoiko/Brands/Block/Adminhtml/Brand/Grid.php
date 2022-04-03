<?php
namespace IhorBoiko\Brands\Block\Adminhtml\Brand;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \IhorBoiko\Brands\Model\brandFactory
     */
    protected $_brandFactory;

    /**
     * @var \IhorBoiko\Brands\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \IhorBoiko\Brands\Model\brandFactory $brandFactory
     * @param \IhorBoiko\Brands\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \IhorBoiko\Brands\Model\BrandFactory $BrandFactory,
        \IhorBoiko\Brands\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_brandFactory = $BrandFactory;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_brandFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'entity_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'entity_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );

		
		$this->addColumn(
			'created_at',
			[
				'header' => __('Created At'),
				'index' => 'created_at',
				'type'      => 'datetime',
			]
		);

			
		$this->addColumn(
			'name',
			[
				'header' => __('Name'),
				'index' => 'name',
			]
		);
		
		$this->addColumn(
			'description',
			[
				'header' => __('Description'),
				'index' => 'description',
			]
		);
		

		$this->addColumn(
			'visibility',
			[
				'header' => __('Visibility'),
				'index' => 'visibility',
				'type' => 'options',
				'options' => \IhorBoiko\Brands\Block\Adminhtml\Brand\Grid::getOptionArray5()
			]
		);



        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

	

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('brands/*/index', ['_current' => true]);
    }

    /**
     * @param \IhorBoiko\Brands\Model\brand|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
		
        return $this->getUrl(
            'brands/*/edit',
            ['entity_id' => $row->getId()]
        );
		
    }

	
		static public function getOptionArray5()
		{
            $data_array=array(); 
			$data_array[0]='Hide';
			$data_array[1]='Show';
            return($data_array);
		}
		static public function getValueArray5()
		{
            $data_array=array();
			foreach(\IhorBoiko\Brands\Block\Adminhtml\Brand\Grid::getOptionArray5() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);
			}
            return($data_array);

		}
		

}