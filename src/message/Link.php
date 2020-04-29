<?php
/**
 * @author zwh
 * @date 20200428
 * @desc link消息
 */

namespace DingBot\Message;


class Link extends Base
{
    public function __construct($options)
    {
        $this->params['msgtype'] = 'link';
        parent::__construct($options);
    }

    public function text($val)
    {
        $this->params['link']['text'] = $val;
        return $this;
    }

    public function title($val)
    {
        $this->params['link']['title'] = $val;
        return $this;
    }

    public function picUrl($val)
    {
        $this->params['link']['picUrl'] = $val;
        return $this;
    }

    public function messageUrl($val)
    {
        $this->params['link']['messageUrl'] = $val;
        return $this;
    }
}