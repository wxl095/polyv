<?php


namespace polyv\src\channel\chat;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use polyv\src\Basic;

/**
 * 查询历史聊天信息
 * Class History
 * @package polyv\src\channel\chat
 */
class History extends Basic
{
    private $url = "https://api.polyv.net/live/v3/channel/chat/get-history";

    public function setChannelId(int $channelId)
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
        $this->params['startTime'] = date("Y-m-d H:i:s", $start_time);
        $this->params['endTime'] = date("Y-m-d H:i:s", $end_time);
    }

    /**
     * 获取第几页聊天记录，默认为1
     * @param int $page
     */
    public function setPage(int $page = 1): void
    {
        $this->params['page'] = $page;
    }

    /**
     * 每页记录数，默认为1000
     * @param int $pageSize
     */
    public function setPageSize(int $pageSize = 1000): void
    {
        $this->params['pageSize'] = $pageSize;
    }

    /**
     * 用户类型，可以选择多个类型，用英文逗号隔开。可选值包括：
     * slice:云课堂学员
     * teacher:讲师
     * guest:嘉宾
     * manager:管理员
     * assistant:助教
     * viewer:特邀观众
     * monitor:场监
     * attendee:研讨会参与者
     * student:普通直播观众
     * @param string $userType
     */
    public function setUserType(string $userType): void
    {
        $this->params['userType'] = $userType;
    }

    /**
     * 聊天记录状态，默认：pass(已审核)，审核状态，pass：已审核，censor：审核中和删除
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->params['status'] = $status;
    }

    /**
     * 类型，不填默认公聊，extend：管理员私聊
     * @param string $source
     */
    public function setSource(string $source): void
    {
        $this->params['source'] = $source;
    }

    /**
     * 如果有房间号，需要传入房间号，默认不传
     * @param string $roomId
     */
    public function setRoomId(string $roomId): void
    {
        $this->params['roomId'] = $roomId;
    }


    public function send(): string
    {
        $request = new Request('POST', $this->url, ['content-type' => 'application/json'], http_build_query($this->params));
        $client = new Client();
        $response = $client->send($request, ['http_errors' => false]);
        return $response->getBody()->getContents();
    }
}