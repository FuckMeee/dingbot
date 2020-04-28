<?php
/**
 * @author zwh
 * @date 20200428
 * @desc markdown消息
 */

namespace DingBot\Message;


class Markdown extends Base
{
    public function __construct()
    {
        $this->params['msgtype'] = 'markdown';
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

    public function title($val)
    {
        $this->params['markdown']['title'] = $val;
        return $this;
    }

    public function text($val)
    {
        $this->params['markdown']['text'] = $val;
        return $this;
    }
}