<?php


namespace polyv\src\channel;


use GuzzleHttp\Client;
use polyv\src\Basic;

class Menu extends Basic
{
    protected $channelId;
    protected $name;
    protected $type;
    protected $content;
    protected $lang = 'zh_CN';

    public function send(): string
    {
        $this->buildData();
        $client = new Client();
        $response = $client->request(
            'POST',
            'https://api.polyv.net/live/v3/channel/menu/add?' . http_build_query($this->params),
            ['http_errors' => false]
        );
        return $response->getBody()->getContents();
    }

    protected function buildData(): void
    {
        parent::buildData();
        $this->params['channelId'] = $this->channelId;
        $this->params['name'] = $this->name;
        $this->params['type'] = $this->type;
        $this->params['content'] = $this->content;
        $this->params['lang'] = $this->lang;
        $this->params['sign'] = $this->config->getSign($this->params);
    }


    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param int $channelId
     */
    public function setChannelId(int $channelId): void
    {
        $this->channelId = $channelId;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @param string $lang
     */
    public function setLang(string $lang): void
    {
        $this->lang = $lang;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }
}