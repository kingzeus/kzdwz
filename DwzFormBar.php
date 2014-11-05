<?php

/**
 * @version 0.1
 * @author kingzeus
 */


/**
 * 使用方法
	<?php $this->widget('ext.dwz.DwzFormBar',array(
		'title'=>'Panel标题',
		'content'=>'Panel内容',
		...
	)); ?>
 * 生成
 * <pre>
		<div class="formBar">
			<ul>
				<!--<li><a class="buttonActive" href="javascript:;"><span>保存</span></a></li>-->
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li>
					<div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
				</li>
			</ul>
		</div>
 * </pre>
 * 
 */
class DwzFormBar extends CWidget
{
	public $buttons=array();
	public $htmlOptions=array();
	public $tagName='div';
	public $buttonTemplate= '<button type="{type}" {class}>{title}</button>';

	public function run()
	{
		$class='formBar';
		if (isset($this->htmlOptions['class']))
			$this->htmlOptions['class']=$class.' '.$this->htmlOptions['class'];
		else
			$this->htmlOptions['class']=$class;

		echo CHtml::openTag($this->tagName,$this->htmlOptions)."<ul>";

		foreach ($this->buttons as $title=>$button)
		{
			if (is_array($button))
			{
				echo "<li>";
				if (isset($button['active'])&& $button['active'])
					echo '<div class="buttonActive">';
				else
					echo '<div class="button">';
				echo '<div class="buttonContent">';
				
				$classCotent='';
				if (isset($button['class']))
					$classCotent=strtr('class="{c}"', array('{c}'=>$button['class']));
				
				//类型
				if (isset($button['type']))
					echo strtr($this->buttonTemplate, array('{type}'=>$button['type'],'{title}'=>$title,'{class}'=>$classCotent));
				else
					echo strtr($this->buttonTemplate, array('{type}'=>'button','{title}'=>$title,'{class}'=>$classCotent));
				
				
				echo "</div></div></li>";
			}
		}
		
		
		echo "</ul>";
		

		echo CHtml::closeTag($this->tagName)."\n";
	}
}