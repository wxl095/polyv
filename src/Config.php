<?php

namespace polyv\src;

/**
 * Class Config 保利威账号信息配置
 * @package polyv\src
 */
class Config
{
    /** @var string 保利威appId */
    private $appId;
    private $appSecret;
    private $userId;
    protected $timestamp;

    /**
     * Config constructor.
     * @param $app_id
     * @param $app_secret
     * @param $user_id
     */
    public function __construct($app_id, $app_secret, $user_id)
    {
        $this->appId = $app_id;
        $this->appSecret = $app_secret;
        $this->userId = $user_id;
        [$s1, $s2] = explode(' ', microtime());
        $this->timestamp = sprintf('%.0f', ($s1 + $s2) * 1000);
    }

    /**
     * 获取签名
     * @param $params
     * @return string
     */
    public function getSign($params): string
    {
        ksort($params, SORT_ASC);
        $str = $this->appSecret;
        foreach ($params as $key => $value) {
            $str .= $key;
            $str .= $value;
        }
        return strtoupper(md5($str . $this->appSecret));
    }

    /**
     * @return string
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * @return string
     */
    public function getAppSecret(): string
    {
        return $this->appSecret;
    }

    /**
     * 获取用户ID
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }


    /**
     * @return string
     */
    public function getTimestamp(): string
    {
        return $this->timestamp;
    }
}
