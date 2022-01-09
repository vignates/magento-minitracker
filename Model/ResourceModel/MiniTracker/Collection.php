<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vignates\MiniTracker\Model\ResourceModel\MiniTracker;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'minitracker_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Vignates\MiniTracker\Model\MiniTracker::class,
            \Vignates\MiniTracker\Model\ResourceModel\MiniTracker::class
        );
    }
}

