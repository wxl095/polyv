<?php


namespace polyv\src\channel;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use polyv\src\Basic;

/**
 * 创建并初始化频道
 * Class basicCreate
 * @package polyv\src\channel
 */
class BasicSettings extends Basic
{
    protected $url = "https://api.polyv.net/live/v3/channel/basic/update";
    protected $channelId;
    protected $settings = [
        'basicSetting' => [
            "name" => "",// 频道名称
            "channelPasswd" => "",// 频道密码,长度不能超过16位
            "publisher" => "",// 	主持人名称
            "startTime" => 0,// 直播开始时间，13位时间戳，设置为0 表示关闭直播开始时间显示
            "pageView" => 1000,// 	累积观看数
            "likes" => 666,// 点赞数
            "coverImg" => "https://my.polyv.net/v_22/assets/dist/images/navbar/logo.png",// 封面图片地址
            "splashImg" => "https://my.polyv.net/v_22/assets/dist/images/navbar/logo.png",// 引导图地址
            "splashEnabled" => "N",// 引导页开关(Y、N)
            "desc" => "直播介绍",//	直播介绍
            "consultingMenuEnabled" => "N",//咨询提问开关
            "maxViewerRestrict" => "Y",// 是否限制最大观看人数
            "maxViewer" => 100,//最大在线人数
            "categoryId" => 0,// 频道的所属分类（分类ID可通过“获取直播分类”接口得到）
            'linkMicLimit' => -1,//连麦人数，-1：使用账号的连麦人数，范围大于等于-1，小于等于账号的连麦人数，最大16人
            'operation' => 'N',//是否增加转播关联，Y：表示增加关联，N：表示取消关联 (注：需要开启频道转播功能该参数才生效)
            'receiveChannelIds' => '',//接收转播频道号，多个频道号用半角逗号,隔开(注：需要开启频道转播功能该参数才生效)
            "closeDanmu" => "N",//是否关闭弹幕功能的开关，N表示不关闭，Y表示关闭
            "showDanmuInfoEnabled" => "N"// 默认是否显示弹幕信息开关，Y表示显示，N表示不显示
        ],
    ];

    public function setChannelId($channelId): void
    {
        $this->channelId = $channelId;
    }

    /**
     * 设置频道名称
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->settings['basicSetting']['name'] = $name;
    }

    /**
     * 设置频道密码
     * @param string $channelPasswd
     */
    public function setChannelPasswd(string $channelPasswd): void
    {
        $this->settings['basicSetting']['channelPasswd'] = $channelPasswd;
    }

    /**
     * 设置主持人
     * @param string $publisher
     */
    public function setPublisher(string $publisher): void
    {
        $this->settings['basicSetting']['publisher'] = $publisher;
    }

    /**
     * 设置直播间开始时间
     * @param int $startTime
     */
    public function setStartTime(int $startTime): void
    {
        $this->settings['basicSetting']['startTime'] = $startTime;
    }

    /**
     * 设置累积观看数
     * @param int $pageView
     */
    public function setPageView(int $pageView): void
    {
        $this->settings['basicSetting']['pageView'] = $pageView;
    }

    /**
     * 设置点赞人数
     * @param int $likes
     */
    public function setLikes(int $likes): void
    {
        $this->settings['basicSetting']['likes'] = $likes;
    }

    /**
     * 封面图片地址
     * @param string $url
     */
    public function setCoverImg(string $url): void
    {
        $this->settings['basicSetting']['coverImg'] = $url;
    }

    /**
     * 设置引导图地址
     * @param string $url
     */
    public function setSplashImg(string $url): void
    {
        $this->settings['basicSetting']['splashImg'] = $url;
    }

    /**
     * 设置直播介绍，可以为html代码
     * @param string $desc
     */
    public function setDesc(string $desc): void
    {
        $this->settings['basicSetting']['desc'] = $desc;
    }

    /**
     * 咨询提问开关
     * @param string $consultingMenuEnabled
     */
    public function setConsultingMenuEnabled(string $consultingMenuEnabled = 'N'): void
    {
        $this->settings['basicSetting']['consultingMenuEnabled'] = $consultingMenuEnabled;
    }

    /**
     * 是否限制最大观看人数
     * @param string $maxViewerRestrict
     */
    public function setMaxViewerRestrict(string $maxViewerRestrict = 'Y'): void
    {
        $this->settings['basicSetting']['maxViewerRestrict'] = $maxViewerRestrict;
    }

    /**
     * 设置最大在线观看人数
     * @param string $maxViewer
     */
    public function setMaxViewer(string $maxViewer): void
    {
        $this->settings['basicSetting']['maxViewer'] = $maxViewer;
    }

    /**
     * 频道的所属分类（分类ID可通过“获取直播分类”接口得到）
     * @param int $categoryId
     */
    public function setCategoryId(int $categoryId): void
    {
        $this->settings['basicSetting']['categoryId'] = $categoryId;
    }

    /**
     * 连麦人数，-1：使用账号的连麦人数，范围大于等于-1，小于等于账号的连麦人数，最大16人
     * @param int $linkMicLimit
     */
    public function setLinkMicLimit(int $linkMicLimit): void
    {
        $this->settings['basicSetting']['linkMicLimit'] = $linkMicLimit;
    }

    /**
     * 是否增加转播关联，Y：表示增加关联，N：表示取消关联 (注：需要开启频道转播功能该参数才生效)
     * @param string $operation
     */
    public function setOperation(string $operation): void
    {
        $this->settings['basicSetting']['operation'] = $operation;
    }

    /**
     * 接收转播频道号，多个频道号用半角逗号,隔开(注：需要开启频道转播功能该参数才生效)
     * @param string $receiveChannelIds
     */
    public function setReceiveChannelIdsn(string $receiveChannelIds): void
    {
        $this->settings['basicSetting']['receiveChannelIds'] = $receiveChannelIds;
    }

    /**
     * 是否关闭弹幕功能的开关，N表示不关闭，Y表示关闭
     * @param string $close
     */
    public function setCloseDanmu(string $close = 'Y'): void
    {
        $this->settings['basicSetting']['closeDanmu'] = $close;
    }

    /**
     * 默认是否显示弹幕信息开关，Y表示显示，N表示不显示
     * @param string $enabled
     */
    public function setShowDanmuInfoEnabled(string $enabled = 'N'): void
    {
        $this->settings['basicSetting']['showDanmuInfoEnabled'] = $enabled;
    }

    public function buildData(): void
    {
        parent::buildData();
        $this->params['channelId'] = $this->channelId;
        $this->params['sign'] = $this->config->getSign($this->params);
    }

    public function send(): string
    {
        $request = new request('POST', $this->url . http_build_query($this->params), [], json_encode($this->settings));
        $client = new Client();
        $response = $client->send($request, ['http_errors' => false]);
    }
}