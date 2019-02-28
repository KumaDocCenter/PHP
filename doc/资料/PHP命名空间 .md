# PHP命名空间

[原文](http://www.cnblogs.com/duanbiaowu/p/5086764.html)



## 命名空间的概念

**什么是命名空间？引用官网上的一段话：**

> 从广义上来说，命名空间是一种封装事物的方法。在很多地方都可以见到这种抽象概念。例如，在操作系统中【目录】用来将相关文件分组，对于【目录】中的文件来说，它就扮演了命名空间的角色。举个具体的栗子，在Windos操作系统中，文件 foo.txt 可以同时在目录 d:/example1 和 d:/example2 中存在，但在同一个目录中最多只能存在一个 foo.txt 文件。另外，在【目录】 以外访问 foo.txt 文件时，我们必须将正确【目录】名以及【目录】分隔符放在文件名之前。这个原理应用到程序设计领域就是命名空间的概念。

----



## 命名空间的作用

**命名空间通常用来解决两大类问题：**

1. **用户编写的代码与【PHP内部的类/函数/常量】 或者【第三方类/函数/常量】之间的命名冲突。**

举个栗子：你正在维护一个项目，其中有一个文件: `Member.php` , 其中有一个功能:查询所有用户的基本资料，然后使用CSV文件导出，导出数据到CSV文件的功能是之前的一个哥们写的：他把功能封装到了一个方法里：`OutputStream()`。然而，非常不幸，此时客户新增加了一个需求：导出用户的全部资料，并且保留之前导出基本资料的功能。假设由于个别原因，你不想再使用之前那哥们写的 `OutputStream()` 方法，需要借用第三方类库：`PHPExcel`，最后当你配置成功并且载入类库文件准备开工时，却收到了错误信息：`OutputStream()` 方法重复了（这里假设 `PHPExcel` 类库中也有一个方法叫做 `OutputStream()`， 如果能有个唯一标识该多好？



2. **为很长的命名创建一个别名（或简短）的名称，提高源代码的可读性。**

回到刚才的问题，为了解决 `OutputStream()`方法冲突问题，你想到了一个办法：把之前那哥们写的 `OutputStream()` 加一个项目前缀：`My_OutputStream()`, 然后大功告成（如果 `OutputStream()` 只有一处地方调用）。然而，随着项目的日积月累，项目中类似 `My_…()` 这种代码越来越多，维护也变得日益麻烦。

----



## 定义命名空间

> PHP命名空间中可以包含任意的PHP代码，但是最终只有三种类型会受到影响：**类、函数、常量**，变量和数组等是没有命名空间的概念的。

### 规则：

> 1.命名空间使用 ``namespace`` 来声明；
> 2.如果一个文件中包括命名空间，它必须在所有 PHP 代码前声明命名空间；
> 3.所有非 PHP 代码包括空白符都不能出现在命名空间的声明前；

**简单地来说，如果你要在一个文件中使用命名空间，这样写就对了：**

``` php
namespace FrameWork\MyFrameWork;
```


### 定义子命名空间

> 与目录和文件的关系很象，PHP命名空间也允许指定层次化的命名空间的名称。因此，命名空间的名字可以使用分层次的方式定义：

``` php
namespace FrameWork\MyFrameWork;
namespace FrameWork\MyFrameWork\Model;
namespace FrameWork\MyFrameWork\Controller;
```


### 在同一文件中定义多个命名空间

这个功能大家知道即可，在实际的项目开发中，应该不会出现在同一个文件中定义多个命名空间的这种情况。
详情请看官方文档：[在同一个文件中定义多个命名空间](http://php.net/manual/zh/language.namespaces.definitionmultiple.php)

----



## PHP 中命名空间解析规则

### 1.没有任何前缀的类名称。

例如一个类为 `Controller`, 如果当前命名空间是 `FrameWork` , `Controller` 会被解析为 `FrameWork\Controller`.如果当前命名空间不存在，则 `Controller` 是全局的。

### 2.包含前缀的类名称。

例如 `$exampe = Base\Example()`, 如果当前命名空间是 `Controller`, 则 `Example` 会被解析为 `Controller\Base\Example`, 如果当前命名空间是 `Model`, 则 `Example` 会被解析为 `Model\Base\Example`, 如果当前命名空间不存在，则 `Exampl` 会被解析为 `Base\Example`, (PS:这种解析方式类似 Windows 中相对路径)。

### 3.包含 "\\"+ 前缀的类名称。

例如 `$exampe = \Base\Example()`, 则 `Example` 会被解析为 `Base\Example`, (PS:这种解析方式类似 Windows 中绝对路径)。

> 小技巧：最前面有 “\” 是绝对路径，反之是相对路径。

**举个栗子：**

``` php
/**
* namespace2.php
*/

namespace FrameWork\Base\Controller;
 
class Example 
{
    public static function here() 
    {
        echo 'Namespace is FrameWork\Base\Controller !!<br />';
    }
}

/**
* namespace1.php
*/

namespace FrameWork\Base;

class Example 
{
    public static function here() 
    {
        echo 'Namespace is FrameWork\Base !!<br />';
    }
}

include ('namespace3.php');

//  第一种解析方式：
Example::here();   // Namespace is FrameWork\Base !!

// 第二种解析方式：
Controller\Example::here();  // Namespace is FrameWork\Base\Controller !!

// 第三种解析方式：
\FrameWork\Base\Example::here();                // Namespace is FrameWork\Base !!
\FrameWork\Base\Controller\Example::here();     // Namespace is FrameWork\Base\Controller !!
```

###  4. 使用关键字 use 引入名称空间

   ```php
<?php
use \core\Model;    //最后面的为类名

class a extents Model{ //继承里直接写类名
    
}
   ```



----



## namespace 关键字 和 \_\_NAMESPACE\_\_ 常量

**namespace:** 用来显式访问当前命名空间或子命名空间中的元素。

``` php
namespace\Example::here();    // Namespace is FrameWork\Base !!
```


**\_\_NAMESPACE\_\_ :** 当前命名空间的字符，2个下划线。如果当前命名空间为空, 则返回空 `` "" ``。

``` php
echo __NAMESPACE__;    // FrameWork\Base
```

----



## 命名空间的别名

> PHP 命名空间支持两种别名方式：为类名称使用别名、为命名空间名称使用别名。注意:PHP不支持函数或常量别名。

通过操作符 use 实现别名。

``` php
/**
* namespace4.php
*/

namespace FrameWork\Base\Controller;
 
class Example 
{
    public static function here() 
    {
        echo 'Namespace is FrameWork\Base\Controller !!<br />';
    }
}

/**
* namespace3.php
*/

namespace Model;

include ('namespace4.php');

use FrameWork\Base\Controller\Example as FBCExample;     

\FrameWork\Base\Controller\Example::here();     // Namespace is FrameWork\Base\Controller !!
FBCExample::here();                             // Namespace is FrameWork\Base\Controller !!
```






