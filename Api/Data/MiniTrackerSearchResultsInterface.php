<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vignates\MiniTracker\Api\Data;

interface MiniTrackerSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get MiniTracker list.
     * @return \Vignates\MiniTracker\Api\Data\MiniTrackerInterface[]
     */
    public function getItems();

    /**
     * Set sku list.
     * @param \Vignates\MiniTracker\Api\Data\MiniTrackerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

