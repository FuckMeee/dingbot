<?php
/**
 * @author zwh
 * @date 20200428
 * @desc text消息
 */

namespace DingBot\Message;


class Text extends Base
{
    public function __construct()
    {
        $this->params['msgtype'] = 'text';
        parent::__construct();
    }

    public function at($val)
    {
        $this->params['at']['atMobiles'][] = $val;
        return $this;
    }

    public function atAll()
    {
        $this->params['at']['isAtAll'] = true;
        return $this;
    }

    public function content($val)
    {
        $this->params['text']['content'] = $val;
        return $this;
    }
}