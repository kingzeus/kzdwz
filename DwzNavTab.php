<?php

/**
 * @version 0.1
 * @author dufei22 <dufei22@gmail.com>
 * @link http://blog.soyoto.com/
 */

Yii::import('ext.dwz.DwzWidget');

/**
 * 使用方法
 * <pre>
	<?php $this->widget('ext.dwz.DwzNavTab', array(
		'tabs'=>array(
			'管理区首页'=>$this->renderPartial('index',null,true),
			...
		),
		...
	)); ?>
 * </pre>
 * 生成如下
	<div id="navTab" class="tabsPage">
		<div class="tabsPageHeader">
			<div class="tabsPageHeaderContent">
				<ul class="navTab-tab">
					<li tabid="main" class="main"><a href="#"><span><span class="home_icon">管理区主页</span></span></a></li>
				</ul>
			</div>
			<div class="tabsLeft">left</div>
			<div class="tabsRight">right</div>
			<div class="tabsMore">more</div>
		</div>
		<ul class="tabsMoreList">
			<li><a href="javascript:void(0)">管理区主页</a></li>
		</ul>
		<div class="navTab-panel tabsPageContent" id="navTab-default">
			<?php echo $content; ?>
		</div>
	</div>
 * 
 */
class DwzNavTab extends DwzWidget
{

	/**
	 * @var $tabs array NavTab初始显示项目 (标题=>内容).
	 */
	public $tabs= array();

	public $headerTemplate= '<li tabid="{tid}" class="main"><a href="javascript:;"><span><span class="home_icon">{title}</span></span></a></li>';
	public $listTemplate=   '<li><a href="javascript:;">{title}</a></li>';
	
	public function run()
	{
		parent::run();
		$headers='';
		$lists='';
		$contents='';
		$countTab=0;

		foreach ($this->tabs as $title=>$content){
			$tabid= 'main'.$countTab++;
			$headers.= strtr($this->headerTemplate, array('{tid}'=>$tabid,'{title}'=>$title))."\n";
			$lists  .= strtr($this->listTemplate, array('{title}'=>$title))."\n";
			$contents.= '<div>'.$content."</div>\n";
		}
		$this->htmlOptions['class']='tabsPage';
		$this->htmlOptions['id']= 'navTab';
		echo CHtml::openTag($this->tagName,$this->htmlOptions)."\n";
		
		
		// 标题
 		echo "<div class='tabsPageHeader'><div class='tabsPageHeaderContent'><ul class='navTab-tab'>";
 		echo $headers;
 		echo "</ul></div>";

 		echo '<div class="tabsLeft">left</div><!-- 禁用只需要添加一个样式 class="tabsLeft tabsLeftDisabled" -->';
 		echo '<div class="tabsRight">right</div><!-- 禁用只需要添加一个样式 class="tabsRight tabsRightDisabled" -->';
 		echo '<div class="tabsMore">more</div></div>';
 		
 		// list
		echo "<ul class='tabsMoreList'>";
 		echo $lists;
 		echo "</ul>";


		// 内容
		echo '<div class="navTab-panel tabsPageContent layoutBox"><div class="page unitBox">';
		echo $contents;
		echo '</div></div>';
		
		echo CHtml::closeTag($this->tagName)."\n";
	}
}