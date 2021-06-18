<?php


namespace polyv\src\channel\statistics;


use GuzzleHttp\Client;
use polyv\src\Basic;

class ViewLog extends Basic
{
    protected $require = ['appId', 'timestamp', 'sign', [['startTime', 'endTime'], ['currentDay']]];
    private $url = "https://api.polyv.net/live/v1/statistics/%s/viewlog?";
    private $channelId;

    /**
     * 设置频道ID
     * @param $channelId
     */
    public function setChannelId($channelId): void
    {
        $this->channelId = $channelId;
    }

    /**
     * 直播账号ID
     * @param $userid
     */
    public function setUserid($userid): void
    {
        $this->params['userId'] = $userid;
    }

    /**
     * 查询日期，格式：yyyy-MM-dd
     */
    public function setCurrentDay($currentDay): void
    {
        $this->params['currentDay'] = $currentDay;
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

//    /**
//     *    观看用户ID
//     * @param string $userid
//     */
//    public function setUserid(string $userid): void
//    {
//        $this->params['param1'] = $userid;
//    }

//    /**
//     * 多个观看用户ID
//     * @param array $userIds
//     * @throws \JsonException
//     */
//    public function setUserIds(array $userIds): void
//    {
//        $this->params['param1s'] = urlencode(json_encode($userIds, JSON_THROW_ON_ERROR));
//    }

    /**
     * 观看用户昵称
     * @param string $nickname
     */
    public function setNickname(string $nickname): void
    {
        $this->params['param2'] = $nickname;
    }

    /**
     *    观看日志类型，取值 vod 表示观看回放，取值live 表示直播
     * @param string $logType
     */
    public function setLogType(string $logType): void
    {
        $this->params['param3'] = $logType;
    }

    /**
     * 每页显示的数据条数，默认每页显示1000条数据
     * @param string $pageSize
     */
    public function setPageSize(string $pageSize): void
    {
        $this->params['pageSize'] = $pageSize;
    }

    /**
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(): string
    {
        parent::send();
        $client = new Client();
        $response = $client->request('GET', sprintf($this->url, $this->channelId) . http_build_query($this->params), ['http_errors' => false]);
        return $response->getBody()->getContents();
    }
}
