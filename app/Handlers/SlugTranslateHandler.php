<?php

namespace App\Handlers;

use GuzzleHttp\Client;
use Overtrue\Pinyin\Pinyin;

class SlugTranslateHandler
{
    public function translate($text)
    {
        // 创建HTTP请求对象
        $http = new Client;

        // 初始化基本配置
        $api = 'http://api.fanyi.baidu.com/api/trans/vip/translate?';
        $appid = config('services.baidu_translate.appid');
        $key = config('services.baidu_translate.key');
        $salt = time();
        // 兼容方案，没有百度翻译配置信息时使用拼音替代方案
        if (empty($appid) || empty($key)) {
            return $this->pinyin($text);
        }

        $sign = md5($appid . $text . $salt . $key);

        $query = http_build_query([
            "q"     =>  $text,
            "from"  => "zh",
            "to"    => "en",
            "appid" => $appid,
            "salt"  => $salt,
            "sign"  => $sign,
        ]);

        $sign = md5($appid. $text . $salt . $key);

        // 发送get请求
        $response = $http->get($api . $query);

        $result = json_decode($response->getbody(), true);

        // 获取翻译结果
        if (isset($result['trans_result'][0]['dst'])) {
            return \Str::slug($result['trans_result'][0]['dst']);
        } else {
            return $this->pinyin($text);
        }
    }

    public function pinyin($text)
    {
        return \Str::slug(app(Pinyin::class)->permalink($text));
    }
}
