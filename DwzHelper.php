<?php

class DwzHelper
{
	static public function IsDwzAjaxRequest()
	{
		if(!Yii::app()->getRequest()->getIsAjaxRequest())
			return false;
		
		return array_key_exists('at', $_REQUEST)&&$_REQUEST['at']='dwz';
	} 
	static public function json($message,$statusCode,$callbackType='closeCurrent',$navTabid='',$forwardUrl='',$rel='',$confirmMsg='')
	{
		$rtn = array(
				'statusCode'	=> $statusCode,
				'message'		=> $message,
				'navTabId'		=> $navTabid,
				'rel'			=> $rel,
				'callbackType'	=> $callbackType,
				'forwardUrl'	=> $forwardUrl,
				'confirmMsg'	=> $confirmMsg
				);
		echo CJSON::encode($rtn);
	}
}
