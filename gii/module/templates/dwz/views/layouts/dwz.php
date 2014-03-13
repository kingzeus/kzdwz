<?php echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->pageTitle; ?> - 后台管理 <?php echo Yii::app()->name; ?></title>
</head>
<?php $this->widget("ext.dwz.DwzWidget"); ?>
<body>
	<div id="layout">
		<div id="header">
			<div class="headerNav">
				<img src="/images/logo1.png" title="<?php echo Yii::app()->name; ?> 后台管理"/>
				<ul class="nav">
					
					<li><?php echo CHtml::link("首页",array("/site/index")); ?></li>
					
					<li><?php echo CHtml::link("退出",array("/site/logout")); ?></li>
				</ul>
				<ul class="themeList" id="themeList">
					<li theme="default"><div class="selected">蓝色</div></li>
					<li theme="green"><div>绿色</div></li>
					<!-- <li theme="red"><div>红色</div></li> -->
					<li theme="purple"><div>紫色</div></li>
					<li theme="silver"><div>银色</div></li>
					<li theme="azure"><div>天蓝</div></li>
				</ul>
			</div>
		</div>

		<div id="leftside">
		<div id="sidebar_s">
			<div class="collapse">
				<div class="toggleCollapse"><div></div></div>
			</div>
		</div>
		<div id="sidebar">
			<div class="toggleCollapse"><h2>主菜单</h2><div>收缩</div></div>
			<?php $this->widget("ext.dwz.DwzAccordion", array(
				"items"=>array(
					"常用管理"=>$this->renderPartial("menu_tree",null,true),
				),
				))?>
		</div>
		</div>
		<div id="container">
			<?php $this->widget("ext.dwz.DwzNavTab", array(
				"tabs"=>array(
					"管理区首页"=>$this->renderPartial("index",null,true),
				)
				)); ?>
		</div>
	</div>

	<div id="footer">
	Copyright &copy; <?php echo date('Y'); ?> <a href="demo_page2.html" target="dialog">DWZ团队</a>
		<?php echo Yii::powered(); ?>
	</div>


</body>
</html>
';