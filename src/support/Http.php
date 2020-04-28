<?php
/**
 * @author zwh
 * @date 20200428
 * @desc http请求封装
 */

namespace DingBot\Support;

class Http
{
    // post 请求
    public static function doPost($url, $data, $options = [])
    {
        return self::doCurl($url, 'post', $data, $options);
    }

    // get请求
    public static function doGet($url, $data=[], $options=[])
    {
        return self::doCurl($url, 'get', $data, $options);
    }

    private static function doCurl($url, $method, $data, $options = [])
    {
        $ch = curl_init();
        if (strtolower($method) === 'post') { // post请求
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } elseif (strtolower($method) === 'get') { // get请求
            if ($data) {
                if (is_array($data)) {
                    $data = http_build_query($data);
                }
                $url .= '?' . $data;
            }
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        // 请求头设置
        if (!empty($options['header'])) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $options['header']);
        }
        // 证书文件设置
        if (!empty($options['ssl_cert'])) {
            if (file_exists($options['ssl_cert'])) {
                curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');
                curl_setopt($ch, CURLOPT_SSLCERT, $options['ssl_cert']);
            } else {
                return [
                    'error' => true,
                    'error_code' => '9999',
                    'error_message' => '[ssl_cert] 文件不存在'
                ];
            }
        }
        // 证书文件设置
        if (!empty($options['ssl_key'])) {
            if (file_exists($options['ssl_key'])) {
                curl_setopt($ch, CURLOPT_SSLKEYTYPE, 'PEM');
                curl_setopt($ch, CURLOPT_SSLKEY, $options['ssl_key']);
            } else {
                return [
                    'error' => true,
                    'error_code' => '9999',
                    'error_message' => '[ssl_key] 文件不存在'
                ];
            }
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);     // 返回数据
        curl_setopt($ch, CURLOPT_TIMEOUT, $options['timeout'] ?? 30);              // 超时时间
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    // 跳过证书检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);    // 从证书中检查SSL加密算法是否存在

        $response = curl_exec($ch);
        $err_code = curl_errno($ch);    //返回当前对话错误消息的数字编号
        $err_msg = curl_error($ch);     //返回当前对话错误消息
        $info = curl_getinfo($ch);      //获取curl连接资源的消息

        curl_close($ch);

        if($response === false) {
            $result = [
                'error' => true,
                'error_code' => $err_code,
                'error_message' => $err_msg
            ];
        } elseif(empty($response)){
            $result = [
                'error' => true,
                'error_code' => '9999',
                'error_message' => 'No Response.'
            ];
        } elseif ($info['http_code'] != 200) {
            $result = [
                'error' => true,
                'error_code' => '9999',
                'error_message' => 'HTTP ERROR ' . $info['http_code']
            ];
        } else{
            $result = json_decode($response,true);
        }

        return $result;

    }
}