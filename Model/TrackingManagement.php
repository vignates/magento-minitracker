<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Vignates\MiniTracker\Model;

use Vignates\MiniTracker\Model\ResourceModel\MiniTracker\CollectionFactory as MiniTrackerCollectionFactory;

class TrackingManagement implements \Vignates\MiniTracker\Api\TrackingManagementInterface
{
    /**
     * @var MiniTrackerCollectionFactory
     */
    protected $miniTrackerCollectionFactory;

    public function __construct(
        MiniTrackerCollectionFactory $miniTrackerCollectionFactory
    ) {
        $this->miniTrackerCollectionFactory = $miniTrackerCollectionFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getTracking()
    {
        $collection = $this->miniTrackerCollectionFactory->create()->addFieldToSelect('*');
        $result[] = ["items"=>$collection->getData()];
        return $result;
    }
}
