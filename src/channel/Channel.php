<?php


namespace polyv\src\channel;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use polyv\src\Basic;
use polyv\src\Config;

class Channel
{
    /**
     * 获取子频道信息
     * @param int $channelId
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function subChannelInfo(int $channelId): string
    {
        $url = "https://api.polyv.net/live/v2/channelAccount/{$channelId}/accounts?";
        $client = new Client();
        $params = ['appId' => $_ENV['POLYV_APP_ID'], 'timestamp' => Basic::getTimestamp()];
        $params['sign'] = Basic::getSign($params);
        $content = $client->get($url . http_build_query($params), ['http_errors' => false])->getBody()->getContents();
        Log::debug($content);
        return $content;
    }
}