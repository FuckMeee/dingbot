<?php
/**
 * @author zwh
 * @date 20200426
 * @desc 静态调用
 */

namespace DingBot;


/**
 * @method \DingBot\Message\Text text($options = []) static
 * @method \DingBot\Message\Link link($options = []) static
 * @method \DingBot\Message\Markdown markdown($options = []) static
 * @method \DingBot\Message\ActionCard actionCard($options = []) static
 * @method \DingBot\Message\FeedCard feedCard($options = []) static
 *
 */
class DingBot
{
    /**
     * 静态魔术加载方法
     * @param string $name 静态类名
     * @param array $arguments 参数集合
     * @return mixed
     * @throws \Exception
     */
    public static function __callStatic($name, $arguments)
    {
        $name = ucfirst($name);
        $class = 'DingBot\\Message\\' . $name;
        if (!class_exists($class)) {
            throw new \Exception('消息类型不存在');
        }
        $option = array_shift($arguments);
        return new $class($option);
    }
}