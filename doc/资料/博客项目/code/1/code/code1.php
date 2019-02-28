

用户表
user
id,用户名,帐号,密码,权限
id,username,acc,pwd,type


type=0    表示普通用户
type=1    表示管理员





name                            id                 parent_id

手机                              1                       0
    安卓手机                    2                       1
            荣耀10              3                       2
            荣耀11              4                       2
            荣耀12              5                       2
    IOS手机                    6                       1
            果1                   7                       6
            果2                  10
            果3                  12
    塞班手机
            诺基1
            诺基2
            诺基3
电脑
    平板
        微软平板
        IPAD
    台式
    笔记本
服装
    男装
        休闲
        运动
        正装
    女装
        休闲
        运动
        时装
            呢料裙
            xuyue裙













数据库名：blog31
表前缀：bg_

user      article     comment     category