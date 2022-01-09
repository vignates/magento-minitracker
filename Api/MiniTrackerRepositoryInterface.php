<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vignates\MiniTracker\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface MiniTrackerRepositoryInterface
{

    /**
     * Save MiniTracker
     * @param \Vignates\MiniTracker\Api\Data\MiniTrackerInterface $miniTracker
     * @return \Vignates\MiniTracker\Api\Data\MiniTrackerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Vignates\MiniTracker\Api\Data\MiniTrackerInterface $miniTracker
    );

    /**
     * Retrieve MiniTracker
     * @param string $minitrackerId
     * @return \Vignates\MiniTracker\Api\Data\MiniTrackerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($minitrackerId);

    /**
     * Retrieve MiniTracker matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Vignates\MiniTracker\Api\Data\MiniTrackerSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete MiniTracker
     * @param \Vignates\MiniTracker\Api\Data\MiniTrackerInterface $miniTracker
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Vignates\MiniTracker\Api\Data\MiniTrackerInterface $miniTracker
    );

    /**
     * Delete MiniTracker by ID
     * @param string $minitrackerId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($minitrackerId);
}

