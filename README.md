kzdwz
=====

dwz for yii

- 原始地址：[http://www.yiiframework.com/extension/dwzinterface](http://www.yiiframework.com/extension/dwzinterface "http://www.yiiframework.com/extension/dwzinterface")
- 原始版本：0.5

- jui 项目地址[https://code.csdn.net/dwzteam/dwz_jui](https://code.csdn.net/dwzteam/dwz_jui "dwz jui项目地址")
- dwz版本：master（f3870fd52ccc7821b29f925c268532f4a516d208） 2014-01-13


## 安装 ##
1. 解压zip文件
2. 把**dwz**复制到**\protected\extensions**下
3. 修改配置文件
    ```php
	'modules'=>array(
		'admin',
		'gii'=>array(
			'class'=>'system.gii.giiModule',
			'password'=>'admin',
			'generatorPaths'=>array(
				'ext.dwz.gii', //可以继续配置其他路径
				'ext.dwz.giix', //可以继续配置其他路径
            ),
		),
	),
	```
 4. 




