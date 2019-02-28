<?php

#定义项目路径常量
//define('ROOT', dirname(__FILE__));//网站根目录路径
define('ROOT', dirname(dirname(__FILE__)));//网站根目录路径

define('APP_PATH', ROOT.'/app/');//   mvc/app/
define('CORE_PATH', ROOT.'/core/');//   mvc/core/
define('PLUGINS_PATH', ROOT.'/plugins/');//   mvc/plugins/
define('CONF_PATH', ROOT.'/conf/');//   mvc/conf/

define('APP_ADMIN_PATH', APP_PATH.'admin/');//   mvc/app/admin/
define('APP_MODEL_PATH', APP_PATH.'model/');//   mvc/app/model/
define('APP_HOME_PATH', APP_PATH.'home/');//   mvc/app/home/

define('APP_ADMIN_CONTR_PATH', APP_ADMIN_PATH.'controller/');//   mvc/app/admin/controller/
define('APP_ADMIN_VIEW_PATH', APP_ADMIN_PATH.'view/');//   mvc/app/admin/view/
define('APP_HOME_CONTR_PATH', APP_HOME_PATH.'controller/');//   mvc/app/home/controller/
define('APP_HOME_VIEW_PATH', APP_HOME_PATH.'view/');//   mvc/app/home/view/