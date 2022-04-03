<?php
/**
 * Created by PhpStorm.
 * User: ihorboiko
 * Date: 02.04.2022
 * Time: 00:38
 */

namespace IhorBoiko\Brands\Model;


use IhorBoiko\Brands\Api\Data\IhorBoikoBrandsInterface;

class BrandRepositoryModel implements \IhorBoiko\Brands\Api\IhorBoikoBrandsRepositoryInterface
{

    /**
     * @var \Mageprince\Test\Model\ResourceModel\Test\CollectionFactory
     */
    protected $CollectionFactory;
    /**
     * @var \Mageprince\Test\Api\Data\TestSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;
    public function __construct(
        \IhorBoiko\Brands\Model\BrandFactory $CollectionFactory,
        \IhorBoiko\Brands\Api\Data\IhorBoikoBrandsSearchResultsInterface $searchResultsFactory
    ) {
        $this->CollectionFactory = $CollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }
    /**
     * @inheritdoc
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $collection = $this->testCollectionFactory->create();
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        $searchResults->setTotalCount($collection->getSize());
        $sortOrdersData = $searchCriteria->getSortOrders();
        if ($sortOrdersData) {
            foreach ($sortOrdersData as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());
        $searchResults->setItems($collection->getData());
        return $searchResults;
    }
}
