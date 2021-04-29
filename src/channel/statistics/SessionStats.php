<?php


namespace polyv\src\channel\statistics;

use GuzzleHttp\Client;
use polyv\src\Basic;

/**
 * 统计直播间内多场次的直播和观看数据
 * Class SessionStats
 * @package polyv\src\channel\statistics
 */
class SessionStats extends Basic
{
    protected $url = "https://api.polyv.net/live/v3/channel/statistics/get-session-stats?";
    protected $channelId;
    protected $startTime;
    protected $endTime;
    protected $sessionIds;

    public function setChannelId(int $channelId): void
    {
        $this->channelId = $channelId;
    }

    public function setQueryTime(int $start_time, int $end_time): void
    {
        $this->startTime = $start_time;
        $this->endTime = $end_time;
    }

    public function setSessionIds(array $sessionIds): void
    {
        $this->sessionIds = implode(',', $sessionIds);
    }


    protected function buildData(): void
    {
        parent::buildData();
        $this->params['channelId'] = $this->channelId;
        if ($this->startTime && $this->endTime) {
            $this->params['startTime'] = $this->startTime;
            $this->params['endTime'] = $this->endTime;
        }
        if ($this->sessionIds) {
            $this->params['sessionIds'] = $this->sessionIds;
        }
        $this->params['sign'] = $this->config->getSign($this->params);
    }

    public function send(): string
    {
        $client = new Client();
        $response = $client->request('GET', $this->url . http_build_query($this->params));
        return $response->getBody()->getContents();
    }
}