<?php


namespace polyv\src;


abstract class Basic
{
    protected $config;
    protected $params;

    public function __construct()
    {
        $this->config = new Config($_ENV['POLYV_APP_ID'], $_ENV['POLYV_APP_SECRET'], $_ENV['POLYV_USER_ID']);
    }

    public function send(): string
    {
        $this->buildData();
        $this->params['sign'] = $this->config->getSign($this->params);
    }

    protected function buildData(): void
    {
        $this->params['appId'] = $this->config->getAppId();
        $this->params['timestamp'] = $this->config->getTimestamp();
    }
}