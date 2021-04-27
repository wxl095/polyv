<?php

namespace polyv\src\channel;

use polyv\src\Basic;

/**
 * 创建并初始化频道
 * Class basicCreate
 * @package polyv\src\channel
 */
class AuthSettings extends Basic
{
    protected $url = "https://api.polyv.net/live/v3/channel/auth/update";
    protected $settings = [
        'authSettings' => [
            [
                [
                    "rank" => 1,// 主要观看条件为1，次要观看条件为2
                    "enabled" => "Y",// 	是否开启，Y为开启，N为关闭
                    "authType" => "external",//付费观看-pay，验证码观看-code，白名单观看-phone，登记观看-info，自定义授权观看-custom，外部授权-external,直接授权-direct
                    "externalKey" => "L0EjokKI4O",
                    "externalUri" => "",
                    'externalRedirectUri' => ''
                ]
            ]
        ],
    ];

    /**
     * 主要观看条件为1，次要观看条件为2
     * @param int $rank
     */
    public function setRank(int $rank): void
    {
        $this->settings['authSettings'][0]['rank'] = $rank;
    }

    /**
     * 是否开启，Y为开启，N为关闭
     * @param string $enabled
     */
    public function setEnabled(string $enabled): void
    {
        $this->settings['authSettings'][0]['enabled'] = $enabled;
    }

    /**
     * 付费观看-pay，验证码观看-code，白名单观看-phone，登记观看-info，自定义授权观看-custom，外部授权-external,直接授权-direct
     * @param string $authType
     */
    public function setAuthType(string $authType): void
    {
        $this->settings['authSettings'][0]['authType'] = $authType;
    }

    public function setExternalKey($externalKey): void
    {
        $this->settings['authSettings'][0]['externalKey'] = $externalKey;
    }

    /**
     * 自定义url
     * @param string $externalUri
     */
    public function setExternalUri(string $externalUri): void
    {
        $this->settings['authSettings'][0]['externalUri'] = $externalUri;
    }

    /**
     * 跳转地址
     * @param string $externalRedirectUri
     */
    public function setExternalRedirectUri(string $externalRedirectUri): void
    {
        $this->settings['authSettings'][0]['externalRedirectUri'] = $externalRedirectUri;
    }


//    public function check()
//    {
//        $this->settings['authSettings']
//    }


    public function send(): string
    {
    }

    public function buildData(): void
    {
        parent::buildData();

    }
}