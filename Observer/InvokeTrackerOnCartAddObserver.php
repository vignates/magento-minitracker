<?php
/**
 * InvokeTrackerOnCartAddObserver
 *
 * @copyright Copyright © 2022 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace Vignates\MiniTracker\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Vignates\MiniTracker\Publisher\ProductDataPublisher;

class InvokeTrackerOnCartAddObserver implements ObserverInterface
{
    protected $logger;
    protected $_productDataPublisher;

    /**
     * InvokeTrackerOnCartAddObserver constructor.
     * @param LoggerInterface $logger
     * @param ProductDataPublisher $_productDataPublisher
     */
    public function __construct(
        LoggerInterface $logger,
        ProductDataPublisher $_productDataPublisher
    ) {
        $this->logger = $logger;
        $this->_productDataPublisher = $_productDataPublisher;
    }
    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        try {
            $product = $observer->getEvent()->getProduct();
            $data["sku"] = $product->getSku();
            $data["price"] = $product->getFinalPrice();
            $this->_productDataPublisher->publish($data);
        } catch (\Exception $e) {
            $this->logger->error("Data is not publishted: " . $e->getMessage());
        }
    }
}
