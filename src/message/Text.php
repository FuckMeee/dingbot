<?php
/**
 * @author zwh
 * @date 20200428
 * @desc text消息
 */

namespace DingBot\Message;


class Text extends Base
{
    public function __construct($options)
    {
        $this->params['msgtype'] = 'text';
        parent::__construct($options);
    }

    /**
     * @param mixed $val
     *  string e.g. '13300000001'
     *  array  e.g. ['13300000001','13300000002']
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

    public function content($val)
    {
        $this->params['text']['content'] = $val;
        return $this;
    }
}