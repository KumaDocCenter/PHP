 **Call to undefined function think\mb_strlen()，调用未定义的方法 think\mb_strlen()  **

答：没有定义mb_strlen，这是PHP系统函数，`php.ini`没开mb字符支持，`;extension=php_mbstring.dll`把前面的分号去掉，并重启web服务器，这样mb_substr函数就可以生效了。注意，不同版本可能不同，搜索类似的字符，如 `mbstring`



----



**composer 报错： The openssl extension is required for SSL/TLS protection but is not available.** 

答：需要在`php.ini`中开启 `;extension=openssl`，搜索类似字符串 `openssl ` 



----

