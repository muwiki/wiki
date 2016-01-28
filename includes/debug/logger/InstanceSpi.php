<?php

namespace MediaWiki\Logger;

use Kdyby\Monolog\Logger;

class InstanceSpi implements Spi
{

    /**
     * @var Logger
     */
    private $logger;



    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }



    public function getLogger($channel)
    {
        return $this->logger->channel($channel);
    }

}
