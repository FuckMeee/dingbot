# DingBot

## 安装

~~~
composer require weihaozhu/dingbot @dev
~~~

## 使用

消息类型 text,link,markdown,actionCard,feedCard  
  
1）静态类调用
```php
    $config = ['url' => '', 'sign_key' => ''];
    DingBot::text($config)->content('')->send();  
```
2）new实例调用
```php
    $config = ['url' => '', 'sign_key' => ''];
    $text = new Text($config);
    $text->content('')->send();
```
* 其他消息类型以及其方法请阅读代码