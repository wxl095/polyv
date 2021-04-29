<?php


namespace polyv\src\channel\statistics;


use GuzzleHttp\Client;
use polyv\src\Basic;

class Viewlog extends Basic
{
//    public function query($channelId, $page, $startTime, $endTime)
//    {
//
//    }
    private $require = ['appId', 'timestamp', 'page', 'startTime&&endTime||currentDay', 'sign'];
    private $url = "https://api.polyv.net/live/v2/statistics/{channelId}/viewlog?";

    public function setPage($page): void
    {
        $this->params['page'] = $page;
    }

    /**
     * 查询日期，格式：yyyy-MM-dd
     */
    public function setCurrentDay($currentDay): void
    {
        $this->params['currentDay'] = $currentDay;
    }

    public function setQueryTime(int $start_time, int $end_time): void
    {
        $this->params['startTime'] = $start_time;
        $this->params['endTime'] = $end_time;
    }

    /**
     *    观看用户ID
     * @param string $userid
     */
    public function setUserid(string $userid): void
    {
        $this->params['param1'] = $userid;
    }

    /**
     * 多个观看用户ID
     * @param array $userIds
     * @throws \JsonException
     */
    public function setUserIds(array $userIds): void
    {
        $this->params['param1s'] = urlencode(json_encode($userIds, JSON_THROW_ON_ERROR));
    }

    /**
     * 观看用户昵称
     * @param string $nickname
     */
    public function setNickname(string $nickname)
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


    protected function buildData(): void
    {
        parent::buildData();
        $this->params['sign'] = $this->config->getSign($this->params);
    }

    public function send(): string
    {
        $client = new Client();
        $client->request('GET', $this->url . http_build_query($this->params));
    }
}