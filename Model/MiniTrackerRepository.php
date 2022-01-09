<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vignates\MiniTracker\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Vignates\MiniTracker\Api\Data\MiniTrackerInterface;
use Vignates\MiniTracker\Api\Data\MiniTrackerInterfaceFactory;
use Vignates\MiniTracker\Api\Data\MiniTrackerSearchResultsInterfaceFactory;
use Vignates\MiniTracker\Api\MiniTrackerRepositoryInterface;
use Vignates\MiniTracker\Model\ResourceModel\MiniTracker as ResourceMiniTracker;
use Vignates\MiniTracker\Model\ResourceModel\MiniTracker\CollectionFactory as MiniTrackerCollectionFactory;

class MiniTrackerRepository implements MiniTrackerRepositoryInterface
{

    /**
     * @var MiniTrackerInterfaceFactory
     */
    protected $miniTrackerFactory;

    /**
     * @var MiniTracker
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var MiniTrackerCollectionFactory
     */
    protected $miniTrackerCollectionFactory;

    /**
     * @var ResourceMiniTracker
     */
    protected $resource;

    /**
     * @param ResourceMiniTracker $resource
     * @param MiniTrackerInterfaceFactory $miniTrackerFactory
     * @param MiniTrackerCollectionFactory $miniTrackerCollectionFactory
     * @param MiniTrackerSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceMiniTracker $resource,
        MiniTrackerInterfaceFactory $miniTrackerFactory,
        MiniTrackerCollectionFactory $miniTrackerCollectionFactory,
        MiniTrackerSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->miniTrackerFactory = $miniTrackerFactory;
        $this->miniTrackerCollectionFactory = $miniTrackerCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(MiniTrackerInterface $miniTracker)
    {
        try {
            $this->resource->save($miniTracker);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the miniTracker: %1',
                $exception->getMessage()
            ));
        }
        return "Success";
    }

    /**
     * @inheritDoc
     */
    public function get($miniTrackerId)
    {
        $miniTracker = $this->miniTrackerFactory->create();
        $this->resource->load($miniTracker, $miniTrackerId);
        if (!$miniTracker->getId()) {
            throw new NoSuchEntityException(__('MiniTracker with id "%1" does not exist.', $miniTrackerId));
        }
        return $miniTracker;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->miniTrackerCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(MiniTrackerInterface $miniTracker)
    {
        try {
            $miniTrackerModel = $this->miniTrackerFactory->create();
            $this->resource->load($miniTrackerModel, $miniTracker->getMinitrackerId());
            $this->resource->delete($miniTrackerModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the MiniTracker: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($miniTrackerId)
    {
        return $this->delete($this->get($miniTrackerId));
    }
}
