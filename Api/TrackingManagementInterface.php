<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Vignates\MiniTracker\Api;

interface TrackingManagementInterface
{

    /**
     * GET for tracking api
     * @return array
     */
    public function getTracking();
}

