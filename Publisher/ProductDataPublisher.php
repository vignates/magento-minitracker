<?php

namespace Vignates\MiniTracker\Publisher;
use Magento\Framework\MessageQueue\PublisherInterface;

/**
 * Add Product data To Queue
 */
class ProductDataPublisher{

    const TOPIC_NAME= "product_integration";
    /**
     * @var PublisherInterface
     */
    private $publisher;

    /**
     * CustomerPublisher constructor.
     * @param PublisherInterface $publisher
     */
    public function __construct(
        PublisherInterface $publisher
    ) {
        $this->publisher = $publisher;
    }

    /**
     * Publisher
     * @param UpdateProductDataManagementInterface $data
     */
    public function publish(array $data)
    {
        return $this->publisher->publish(self::TOPIC_NAME, json_encode($data));
    }
}
