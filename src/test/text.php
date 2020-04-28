<?php

// 1. 加载入口文件
require '../../include.php';

// 2. 加载配置文件
$config = require './config.php';
$text = new \Message\Text($config);
$text->content('111')->send();
//$res = \DingBot::text($config)->content('测试哦')->atAll()->send();