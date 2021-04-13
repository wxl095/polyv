<?php


namespace polyv\src;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

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

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function create(): void
    {
        $request = new Request(
            'POST',
            'https://api.polyv.net/live/v2/channels/',
            [],
            $this->buildData()
        );

        $client = new Client();
        $response = $client->send($request, ['http_errors' => false]);

        dd($response->getBody()->getContents());
    }


    /**
     * @param int $autoPlay
     * @return DirectBroadcast
     */
    public function setAutoPlay(int $autoPlay): self
    {
        $this->autoPlay = $autoPlay;
        return $this;
    }

    /**
     * @param string $channelPasswd
     * @return DirectBroadcast
     */
    public function setChannelPasswd(string $channelPasswd): self
    {
        $this->channelPasswd = $channelPasswd;
        return $this;
    }

    /**
     * @param Config $config
     * @return DirectBroadcast
     */
    public function setConfig(Config $config): self
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @param string $scene
     * @return DirectBroadcast
     */
    public function setScene(string $scene): self
    {
        $this->scene = $scene;
        return $this;
    }

    /**
     * @param int $linkMicLimit
     * @return DirectBroadcast
     */
    public function setLinkMicLimit(int $linkMicLimit): self
    {
        $this->linkMicLimit = $linkMicLimit;
        return $this;
    }

    /**
     * @param string $name
     * @return DirectBroadcast
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $playerColor
     * @return DirectBroadcast
     */
    public function setPlayerColor(string $playerColor): self
    {
        $this->playerColor = $playerColor;
        return $this;
    }

    /**
     * @param string $pureRtcEnabled
     * @return DirectBroadcast
     */
    public function setPureRtcEnabled(string $pureRtcEnabled): self
    {
        $this->pureRtcEnabled = $pureRtcEnabled;
        return $this;
    }

    /**
     *  构建参数
     * @return string
     */
    public function buildData(): string
    {
        $params = [
            'appId' => $this->config->getAppId(),
            'timestamp' => microtime(),
            'userId' => $this->config->getUserId(),
            'name' => $this->name,
            'channelPasswd' => $this->channelPasswd,
            'autoPlay' => $this->autoPlay,
            'playerColor' => $this->playerColor,
            'scene' => $this->scene,
            'linkMicLimit' => $this->linkMicLimit,
            'pureRtcEnabled' => $this->pureRtcEnabled,
        ];

        $params['sign'] = $this->config->getSign($params);
        return http_build_query($params);
    }
}