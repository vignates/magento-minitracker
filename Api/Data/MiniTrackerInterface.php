<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vignates\MiniTracker\Api\Data;

interface MiniTrackerInterface
{

    const CREATED_AT = 'created_at';
    const TRACKING_MESSAGE = 'tracking_message';
    const SKU = 'sku';
    const MINITRACKER_ID = 'minitracker_id';
    const TRACKING_CODE = 'tracking_code';

    /**
     * Get minitracker_id
     * @return string|null
     */
    public function getMinitrackerId();

    /**
     * Set minitracker_id
     * @param string $minitrackerId
     * @return \Vignates\MiniTracker\MiniTracker\Api\Data\MiniTrackerInterface
     */
    public function setMinitrackerId($minitrackerId);

    /**
     * Get sku
     * @return string|null
     */
    public function getSku();

    /**
     * Set sku
     * @param string $sku
     * @return \Vignates\MiniTracker\MiniTracker\Api\Data\MiniTrackerInterface
     */
    public function setSku($sku);

    /**
     * Get tracking_code
     * @return string|null
     */
    public function getTrackingCode();

    /**
     * Set tracking_code
     * @param string $trackingCode
     * @return \Vignates\MiniTracker\MiniTracker\Api\Data\MiniTrackerInterface
     */
    public function setTrackingCode($trackingCode);

    /**
     * Get tracking_message
     * @return string|null
     */
    public function getTrackingMessage();

    /**
     * Set tracking_message
     * @param string $trackingMessage
     * @return \Vignates\MiniTracker\MiniTracker\Api\Data\MiniTrackerInterface
     */
    public function setTrackingMessage($trackingMessage);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Vignates\MiniTracker\MiniTracker\Api\Data\MiniTrackerInterface
     */
    public function setCreatedAt($createdAt);
}

