<?php
/**
 * @author zwh
 * @date 20200428
 * @desc markdown消息
 */

namespace DingBot\Message;


class Markdown extends Base
{
    public function __construct($options)
    {
        $this->params['msgtype'] = 'markdown';
        parent::__construct($options);
    }

    /**
     * @param mixed $val
     *  string e.g. '13300000001'
     *  array e.g. ['13300000001','13300000002']
     * @return $this
     */
    public function at($val)
    {
        if (is_array($val)) {
            foreach ($val as $item) {
                $this->at($item);
            }
            return $this;
        }
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