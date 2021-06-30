<?php


namespace polyv\src;


abstract class Basic
{
    protected $config;
    protected $params;

    public function __construct()
    {
        $this->config = new Config($_ENV['POLYV_APP_ID'], $_ENV['POLYV_APP_SECRET'], $_ENV['POLYV_USER_ID']);
    }

    public function send()
    {
        $this->buildData();
        $this->params['sign'] = $this->config->getSign($this->params);
        $this->check();
    }

    protected function buildData(): void
    {
        $this->params['appId'] = $this->config->getAppId();
        $this->params['timestamp'] = $this->config->getTimestamp();
    }

    public function check(): void
    {
        $require = $this->require;
        $params = $this->params;
        foreach ($require as $item) {
            if (is_string($item) && empty($params[$item])) {
                throw new \InvalidArgumentException("{$item}为必须参数");
            }
            if (is_array($item)) {
                $switch = [];
                array_walk($item, static function ($value, $k) use ($params, &$switch) {
                    if (is_array($value)) {
                        array_walk($value, static function ($val) use (&$switch, $k, $params) {
                            if (!empty($params[$val])) {
                                $switch[$k] = true;
                            } else {
                                $switch[$k] = false;
                            }
                        });
                    }
                    if (is_string($value) && empty($params[$value])) {
                        $switch[$k] = false;
                    }
                });
                if (!in_array(true, $switch, true)) {
                    $error = '';
                    array_walk($item, static function ($value) use (&$error) {
                        if (is_array($value)) {
                            $error .= trim(implode('、', $value), '、');
                        }
                        if (!empty($error) && is_string($value)) {
                            $error .= '或' . $value;
                        }
                    });
                    throw new \InvalidArgumentException("{$error}至少填写一个");
                }
            }
        }
    }

    public static function getSign($params): string
    {
        ksort($params, SORT_ASC);
        $str = $_ENV['POLYV_APP_SECRET'];
        foreach ($params as $key => $value) {
            $str .= $key;
            $str .= $value;
        }
        return strtoupper(md5($str . $_ENV['POLYV_APP_SECRET']));
    }

    public static function getTimestamp(): string
    {
        [$s1, $s2] = explode(' ', microtime());
        return sprintf('%.0f', ($s1 + $s2) * 1000);
    }
}