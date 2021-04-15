<?php


namespace polyv\src\channel;


use polyv\src\Config;

abstract class Channel
{
    protected $config;
    protected $params;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function send(): string
    {

    }

    protected function buildData(): void
    {
        $this->params['appId'] = $this->config->getAppId();
        $this->params['timestamp'] = $this->config->getTimestamp();
    }
}