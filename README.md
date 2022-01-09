# Mage2 Module Vignates MiniTracker

    ``vignates/module-minitracker``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
The mini Tracker lets you to send the product data to super tracker to get tracking info which then stored in DB.

## Installation
\* = in production please use the `--keep-generated` option

### Zip file

 - Unzip the zip file in `app/code/Vignates`
 - Enable the module by running `php bin/magento module:enable Vignates_MiniTracker`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration

 - Configure Message queues
 - Run `php bin/magento setup:upgrade` to create new topic in queue for Product integration
 - Run `php bin/magento queue:consume:list` to list all the available queues and you'll find `productIntegrationConsumer` if MQ is set properly
 - Run `php bin/magento queue:consume:start productIntegrationConsumer` to start the queue


## Specifications

 - API Endpoint
	- GET - V1/vignates-minitracker/tracking
	- POST - V1/vignates-minitracker/minitracker

 - Model
	- MiniTracker
	- MiniTrackerRepoistory
	- TrackingManagement
 - Observer
    - InvokeTrackerOnCartAddObserver
 - Publisher
    - ProductDataPublisher
 - Consumer
    - ProductIntegration(Super tracker integration)
