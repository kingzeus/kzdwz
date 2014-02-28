<?php
/**
 * CDwzWidget class file.
 *
 * @author dufei22 <dufei22@gmail.com>
 * @license http://www.yiiframework.com/license/
 */

class DwzWidget extends CWidget
{
	/**
	 * 资源文件所在的文件夹（js、themes等文件夹所在的地方。）
	 * 后面的jscriptUrl和themesUrl都是基于这个目录的，dwz.frag.xml也是在这个目录下
	 */
	public $baseUrl;
	public $scriptUrl;
	public $themeUrl;
	public $uploadifyUrl;
	/**
	 * 主题名，默认default
	 */
	public $theme='default';

	/**
	 * js名称，默认是dwz.min.js包含所有dwz所用的脚本，如果用数组指定则会引用所有数组指定的js
	 */
	public $scriptFile=array('dwz.min.js'=>'bin');

	/**
	 * 核心css文件，默认core是主题目录下的css/core.css
	 */
	public $coreCssFile=array(
			'core.css'=>'screen',
			'print.css'=>'print',
	);
	/**
	 * ie修复css文件，默认core是主题目录下的css/ieHack.css
	 */
	public $ieHackCssFile='ieHack.css';
	/**
	 * css名称，默认是style.css在主题目录中。如果是数组则会引用数组中的css
	 */
	public $cssFile=array('style.css'=>'screen');

	public $uploadifyCssFile=array('uploadify.css'=>'screen');
	/**
	 * 配置DWZ的js选项，备用，此项目前没作用
	 */
	public $options=array();

	/**
	 * yii的htmlOptions选项
	 */
	public $htmlOptions=array();
	public $tagName='div';

	/**
	 * 初始化
	 */
	public function init()
	{
		$this->resolvePackagePath();
		$this->registerCoreScripts();
		$this->registerScripts();
		parent::init();
	}

	public function registerScripts() {
		Yii::app()->getClientScript()->registerScript(__CLASS__,"
			$(function(){
				DWZ.init('{$this->baseUrl}/dwz.frag.xml', {
					loginUrl:'login_dialog.html', loginTitle:'登录',	// 弹出登录对话框
					statusCode:{ok:200, error:300, timeout:301}, //【可选】
					pageInfo:{pageNum:'pageNum', numPerPage:'numPerPage', orderField:'orderField', orderDirection:'orderDirection'}, //【可选】
					debug:true,	// 调试模式 【true|false】
					callback:function(){
						initEnv();
						$('#themeList').theme({themeBase:'".$this->themeUrl."'});
					}
				});
			});					
		");
	}

	protected function resolvePackagePath()
	{
		if($this->baseUrl===null)
		{
			$basePath=Yii::getPathOfAlias('ext.dwz.source');
			$this->baseUrl=Yii::app()->getAssetManager()->publish($basePath);
			if($this->scriptUrl===null)
				$this->scriptUrl=$this->baseUrl.'/js';
			if($this->themeUrl===null)
				$this->themeUrl=$this->baseUrl.'/themes';
			if($this->uploadifyUrl===null)
				$this->uploadifyUrl=$this->baseUrl.'/uploadify';
		}
	}


	protected function registerCoreScripts()
	{
		$cs=Yii::app()->getClientScript();

		if(is_array($this->cssFile)){
			foreach($this->cssFile as $cssFile=>$media)
				$cs->registerCssFile($this->themeUrl.'/'.$this->theme.'/'.$cssFile,$media);
		}
		
		
		if(is_array($this->coreCssFile)){
			foreach($this->coreCssFile as $cssFile=>$media)
				$cs->registerCssFile($this->themeUrl.'/css/'.$cssFile,$media);
		}
		
		if(is_array($this->uploadifyCssFile)){
			foreach($this->uploadifyCssFile as $cssFile=>$media)
				$cs->registerCssFile($this->uploadifyUrl.'/css/'.$cssFile,$media);
		}
		
	
		if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
			$cs->registerCssFile($this->themeUrl.'/css/'.$this->ieHackCssFile);

		$cs->registerCoreScript('jquery');
		$cs->registerScriptFile($this->scriptUrl.'/speedup.js');
		$cs->registerScriptFile($this->scriptUrl.'/jquery.cookie.js');
		$cs->registerScriptFile($this->scriptUrl.'/jquery.bgiframe.js');
		$cs->registerScriptFile($this->scriptUrl.'/jquery.validate.js');
		
		if(is_array($this->scriptFile)){
			foreach($this->scriptFile as $scriptFile=>$dir)
				$cs->registerScriptFile($this->baseUrl.DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR.$scriptFile);
		}
		$cs->registerScriptFile($this->scriptUrl.'/dwz.regional.zh.js');
		// 添加自定义脚本
		$cs->registerScriptFile($this->scriptUrl.'/custom.js');

	}


}
