<?php

namespace Vignates\MiniTracker\Consumer;

use GuzzleHttp\ClientFactory;
use Magento\Framework\Serialize\SerializerInterface;
use Psr\Log\LoggerInterface;
use Vignates\MiniTracker\Api\Data\MiniTrackerInterfaceFactory;
use Vignates\MiniTracker\Api\MiniTrackerRepositoryInterface;

/**
 * Product Integration consumer class
 */
class ProductIntegration
{
    const SUPER_TRACKER = "https://supertracking.view.agentur-loop.com/trackme";

    protected $clientFactory;
    protected $logger;
    protected $miniTrackerRepositoryInterface;
    protected $miniTrackerFactory;
    protected $serializer;

    public function __construct(
        ClientFactory $clientFactory,
        MiniTrackerRepositoryInterface $miniTrackerRepositoryInterface,
        MiniTrackerInterfaceFactory $miniTrackerFactory,
        SerializerInterface $serializer,
        LoggerInterface $logger
    ) {
        $this->clientFactory = $clientFactory;
        $this->miniTrackerRepositoryInterface = $miniTrackerRepositoryInterface;
        $this->miniTrackerFactory = $miniTrackerFactory;
        $this->serializer = $serializer;
        $this->logger = $logger;
    }

    /**
     * @param $operation
     */
    public function consumerProcess($operation)
    {
        try {
            $products = $this->serializer->unserialize($operation);
            print_r($products);
            $response = $this->getTracking($products);
            $responseData = $response->getBody()->getContents();
            $trackerInfo = $this->serializer->unserialize($responseData);
            $this->logger->info(sprintf("Response from supertracker: " . $responseData));
            $this->saveTrackingInfo($products["sku"], $trackerInfo);
        } catch (\Exception $e) {
            $this->logger->critical('Error occured: ', ['exception' => $e]);
        }
    }

    /**
     * Outgoing request to super tracker
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function getTracking(array $data)
    {
        try {
            $client = $this->clientFactory->create(['config' => [
                'base_uri' => self::SUPER_TRACKER
            ]]);

            $response = $client->post(self::SUPER_TRACKER, [
                'json'            => ($data)
            ]);

            return $response;
        } catch (\Exception $e) {
            $this->logger->critical('Error connecting to server' . $e->getMessage());
            $retry = 1;
            if ($retry <=3 && $e->getCode() === 503) {
                $retry++;
                $this->logger->info('Retrying the API call - ' . $retry);
                $this->getTracking($data);
            }
        }
    }

    public function saveTrackingInfo($sku, $trackerInfo)
    {
        if (empty($sku) || empty($trackerInfo)) {
            return;
        }

        $miniTracker = $this->miniTrackerFactory->create();
        $miniTracker->setSku($sku);
        $miniTracker->setTrackingMessage($trackerInfo['message']);
        $miniTracker->setTrackingCode($trackerInfo['code']);
        $this->miniTrackerRepositoryInterface->save($miniTracker);
    }
}
