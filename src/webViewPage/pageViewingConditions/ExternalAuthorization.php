<?php


namespace polyv\src\webViewPage\pageViewingConditions;


use polyv\src\Basic;
//use polyv\src\Config;

class ExternalAuthorization extends Basic
{
    protected $url = "https://live.polyv.cn/watch/";


    public function getWatchUrl()
    {
    }


    protected function getSign()
    {
      return  md5($this->config->getAppSecret().);
    }
}
