<?php


namespace polyv\src;


use GuzzleHttp\Client;

/**
 * 直播创建
 * Class DirectBroadcast
 * @package polyv\src
 */
class DirectBroadcast
{
    /**
     * @var Config
     */
    private $config;
    private $name;
    private $channelPasswd;
    private $autoPlay = 1;
    private $playerColor = '#666666';
    private $scene = 'alone';
    private $linkMicLimit = -1;
    private $pureRtcEnabled = 'N';
    private $maxViewer = 0;
    private $publisher = '主持人';

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * 发送请求创建直播间
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(): string
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

    public function setMaxViewer(int $number): void
    {
        $this->maxViewer = $number;
    }


    public function setPublisher(string $publisher): void
    {
        $this->publisher;
    }

    /**
     *  构建参数
     * @return string
     */
    private function buildData(): string
    {
        [$s1, $s2] = explode(' ', microtime());
        $params = [
            'appId' => $this->config->getAppId(),
            'timestamp' => sprintf('%.0f', ($s1 + $s2) * 1000),
            'userId' => $this->config->getUserId(),
            'name' => $this->name,
            'channelPasswd' => $this->channelPasswd,
            'autoPlay' => $this->autoPlay,
            'playerColor' => $this->playerColor,
            'scene' => $this->scene,
            'linkMicLimit' => $this->linkMicLimit,
            'pureRtcEnabled' => $this->pureRtcEnabled,
            'publisher' => $this->publisher,
        ];
        if ($this->maxViewer !== 0 && $this->maxViewer > 0) {
            $params['maxViewer'] = $this->maxViewer;
        }
        $params['sign'] = $this->config->getSign($params);

        return http_build_query($params);
    }
}