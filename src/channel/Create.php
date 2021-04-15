<?php


namespace polyv\src\channel;

use polyv\src\Config;
use GuzzleHttp\Client;

/**
 * 直播频道创建
 * Class Create
 * @package polyv\src
 */
class Create extends Channel
{
    private $name;
    private $channelPasswd;
    private $autoPlay = 1;
    private $playerColor = '#666666';
    private $scene = 'alone';
    private $linkMicLimit = -1;
    private $pureRtcEnabled = 'N';
    private $maxViewer = 0;


    /**
     * 发送请求创建直播间
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(): string
    {
        $client = new Client();
        $response = $client->request(
            'POST',
            'https://api.polyv.net/live/v2/channels/?' . $this->buildData(),
            ['http_errors' => false]
        );
        return $response->getBody()->getContents();
    }


    /**
     * @param int $autoPlay
     */
    public function setAutoPlay(int $autoPlay): void
    {
        $this->autoPlay = $autoPlay;
    }

    /**
     * @param string $channelPasswd
     */
    public function setChannelPasswd(string $channelPasswd): void
    {
        $this->channelPasswd = $channelPasswd;
    }

    /**
     * @param Config $config
     */
    public function setConfig(Config $config): void
    {
        $this->config = $config;
    }

    /**
     * @param string $scene
     */
    public function setScene(string $scene): void
    {
        $this->scene = $scene;
    }

    /**
     * @param int $linkMicLimit
     */
    public function setLinkMicLimit(int $linkMicLimit): void
    {
        $this->linkMicLimit = $linkMicLimit;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $playerColor
     */
    public function setPlayerColor(string $playerColor): void
    {
        $this->playerColor = $playerColor;
    }

    /**
     * @param string $pureRtcEnabled
     */
    public function setPureRtcEnabled(string $pureRtcEnabled): void
    {
        $this->pureRtcEnabled = $pureRtcEnabled;
    }

    /**
     * @param int $number
     */
    public function setMaxViewer(int $number): void
    {
        $this->maxViewer = $number;
    }

    /**
     *  构建参数
     */
    protected function buildData(): void
    {
        parent::buildData();
        $this->params['userId'] = $this->config->getUserId();
        $this->params['name'] = $this->name;
        $this->params['channelPasswd'] = $this->channelPasswd;
        $this->params['autoPlay'] = $this->autoPlay;
        $this->params['playerColor'] = $this->playerColor;
        $this->params['scene'] = $this->scene;
        $this->params['linkMicLimit'] = $this->linkMicLimit;
        $this->params['pureRtcEnabled'] = $this->pureRtcEnabled;
        $this->params['sign'] = $this->config->getSign($this->params);
    }
}