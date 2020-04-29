<?php
/**
 * @author zwh
 * @date 20200428
 * @desc feedCard消息
 */

namespace DingBot\Message;


class FeedCard extends Base
{
    public function __construct($options)
    {
        $this->params['msgtype'] = 'feedCard';
        parent::__construct($options);
    }

    /**
     * @param mixed $val1
     *  string e.g. 'title'
     *  array e.g. [['title','messageURL','picURL'], ['title2','messageURL2','picURL2']]
     * @param string $val2
     * @param string $val3
     * @return $this
     */
    public function links($val1, $val2 = '', $val3 = '')
    {
        if (is_array($val1)) {
            foreach ($val1 as $item) {
                $this->links($item[0], $item[1], $item[2]);
            }
            return $this;
        }
        $this->params['feedCard']['links'][] = [
            "title" => $val1,
            "messageURL" => $val2,
            "picURL" => $val3,
        ];
        return $this;
    }
}