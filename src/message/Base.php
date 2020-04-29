<?php
/**
 * @author zwh
 * @date 20200428
 * @desc 基类
 */


namespace DingBot\Message;


use DingBot\Support\Http;

class Base
{
    /**
     * 请求路径
     * @var string
     */
    protected $url;

    /**
     * 签名秘钥
     * @var string
     */
    protected $sign_key;

    /**
     * 请求参数
     * @var array
     */
    protected $params = [];

    /**
     * 是否已重试
     * @var bool
     */
    protected $is_try;

    /**
     * 当前请求方法参数
     * @var array
     */
    protected $current_method = [];

    public function __construct($options)
    {
        if (!isset($options['url'])) {
            throw new \Exception('缺少url参数');
        }
        $this->url = $options['url'];
        if (isset($options['sign_key'])) {
            $this->sign_key = $options['sign_key'];
        }
    }

    /**
     * 接口通用POST请求方法
     * @param array $data
     * @param array $options
     * @return array|mixed
     */
    protected function callPostApi($data = [], $options = [])
    {
        $this->registerApi(__FUNCTION__, func_get_args());
        return $this->httpPost($data, $options);
    }

    /**
     * 以POST获取接口数据
     * @param $data
     * @param array $options
     * @return array|mixed
     */
    protected function httpPost($data, $options = [])
    {
        $result = Http::doPost($this->url, $data, $options);
        if (isset($result['error'])) {
            if (isset($this->current_method['method']) && empty($this->is_try)) {
                $this->is_try = true;
                return call_user_func_array([$this, $this->current_method['method']], $this->current_method['arguments']);
            }
        }
        return $result;
    }

    /**
     * 注册当前请求接口
     * @param $method
     * @param array $arguments
     */
    protected function registerApi($method, $arguments = [])
    {
        $this->current_method = ['method' => $method, 'arguments' => $arguments];
    }

    /**
     * 签名
     * @return string
     */
    protected function sign()
    {
        $timestamp = time() * 1000;
        $sign_str = $timestamp . '\n' . $this->sign_key;
        $sign = urlencode(base64_encode(hash_hmac('sha256', $sign_str, $this->sign_key, true)));
        $this->url .= '&timestamp='.$timestamp.'&sign='.$sign;
    }

    public function send()
    {
        $this->sign();
        $data_json = json_encode($this->params, 320);
        $options = ['header' => ['Content-Type: application/json;charset=utf-8']];
        try {
            $result = $this->callPostApi($data_json, $options);
        } catch (\Exception $e) {
            return false;
        }
        return $result;
    }
}