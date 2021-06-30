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
    protected $require = ['appId', 'timestamp', 'sign', 'channelId'];

    /**
     * 设置频道
     * @param int $channelId
     */
    public function setChannelId(int $channelId): void
    {
        $this->params['channelId'] = $channelId;
    }

    /**
     * 设置查询时间范围（10位秒级时间戳）
     * @param int $start_time
     * @param int $end_time
     */
    public function setQueryTime(int $start_time, int $end_time): void
    {
        $this->params['startTime'] = $start_time * 1000;
        $this->params['endTime'] = $end_time * 1000;
    }

    /**
     * 设置场次id
     * @param array $sessionIds
     */
    public function setSessionIds(array $sessionIds): void
    {
        $this->params['sessionIds'] = implode(',', $sessionIds);
    }

    public function send(): string
    {
        parent::send();
        $client = new Client();
        $response = $client->request('GET', $this->url . http_build_query($this->params), ['http_errors' => false]);
        return $response->getBody()->getContents();
    }
}
