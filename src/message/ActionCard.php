<?php
/**
 * @author zwh
 * @date 20200428
 * @desc actionCard消息
 */

namespace DingBot\Message;


class ActionCard extends Base
{
    public function __construct()
    {
        $this->params['msgtype'] = 'actionCard';
        parent::__construct();
    }

    public function title($val)
    {
        $this->params['actionCard']['title'] = $val;
        return $this;
    }

    public function text($val)
    {
        $this->params['actionCard']['text'] = $val;
        return $this;
    }

    public function btnOrientation($val)
    {
        $this->params['actionCard']['btnOrientation'] = $val;
        return $this;
    }

    public function singleTitle($val)
    {
        $this->params['actionCard']['singleTitle'] = $val;
        return $this;
    }

    public function singleURL($val)
    {
        $this->params['actionCard']['singleURL'] = $val;
        return $this;
    }

    /**
     * @param mixed $val1 title
     * @param string $val2 actionURL
     * @return $this
     */
    public function btns($val1, $val2 = '')
    {
        if (is_array($val1)) {
            foreach ($val1 as $item) {
                $this->btns($item[0], $item[1]);
            }
            return $this;
        }
        $this->params['actionCard']['btns'][] = [
            "title" => $val1,
            "actionURL" => $val2
        ];
        return $this;
    }
}