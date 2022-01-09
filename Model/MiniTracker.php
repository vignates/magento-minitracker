<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vignates\MiniTracker\Model;

use Magento\Framework\Model\AbstractModel;
use Vignates\MiniTracker\Api\Data\MiniTrackerInterface;

class MiniTracker extends AbstractModel implements MiniTrackerInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Vignates\MiniTracker\Model\ResourceModel\MiniTracker::class);
    }

    /**
     * @inheritDoc
     */
    public function getMinitrackerId()
    {
        return $this->_get(self::MINITRACKER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setMinitrackerId($minitrackerId)
    {
        return $this->setData(self::MINITRACKER_ID, $minitrackerId);
    }

    /**
     * @inheritDoc
     */
    public function getSku()
    {
        return $this->_get(self::SKU);
    }

    /**
     * @inheritDoc
     */
    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

    /**
     * @inheritDoc
     */
    public function getTrackingCode()
    {
        return $this->_get(self::TRACKING_CODE);
    }

    /**
     * @inheritDoc
     */
    public function setTrackingCode($trackingCode)
    {
        return $this->setData(self::TRACKING_CODE, $trackingCode);
    }

    /**
     * @inheritDoc
     */
    public function getTrackingMessage()
    {
        return $this->_get(self::TRACKING_MESSAGE);
    }

    /**
     * @inheritDoc
     */
    public function setTrackingMessage($trackingMessage)
    {
        return $this->setData(self::TRACKING_MESSAGE, $trackingMessage);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt()
    {
        return $this->_get(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}

