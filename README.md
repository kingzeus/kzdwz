kzdwz
=====

dwz for yii

- 原始地址：[http://www.yiiframework.com/extension/dwzinterface](http://www.yiiframework.com/extension/dwzinterface "http://www.yiiframework.com/extension/dwzinterface")
- 原始版本：0.5


## 安装 ##
1. 解压zip文件
2. 把**dwz**复制到**\protected\extensions**下
3. 修改配置文件
    
	'modules'=>array(
		'admin',
		'gii'=>array(
			'class'=>'system.gii.giiModule',
			'password'=>'admin',
			'generatorPaths'=>array(
				'ext.dwz.gii', //可以继续配置其他路径
            ),
		),
	),




