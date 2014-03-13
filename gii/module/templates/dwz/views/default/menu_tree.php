<?php echo "
<?php \$this->widget('zii.widgets.CMenu',array(
	'activateParents'=>true,
	'htmlOptions'=>array('class'=>'tree treeFolder'),
	'items'=>array(
			
		array('label'=>'页面一(外部页面)', 'url'=>'http://www.baidu.com', 'linkOptions'=>array('target'=>'navTab','rel'=>'page1')),
			
		array('label'=>'机器人管理', 'url'=>array('#'),'items'=>array(
					array('label'=>'机器人列表', 'url'=>array('/admin/bot/admin'), 'linkOptions'=>array('target'=>'navTab','rel'=>'botadmin')),
					array('label'=>'机器人属性管理', 'url'=>array('/admin/articles/admin'), 'linkOptions'=>array('target'=>'navTab','rel'=>'art_manager')),
		)),
	),
)); ?>
	";