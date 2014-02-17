<?php

class DwzHelper
{
// 	static public function ok($message,$statusCode='200',$navTabid='',$forwardUrl='',$callbackType='closeCurrent'){
// 		echo "
// 		<script type='text/javascript'>
// 			var statusCode='$statusCode';
// 			var message='$message';
// 			var navTabId='$navTabid';
// 			var forwardUrl='$forwardUrl';
// 			var callbackType='$callbackType';

// 			var response = {statusCode:statusCode,
// 				message:message,
// 				navTabId:navTabId,
// 				forwardUrl:forwardUrl,
// 				callbackType:callbackType
// 			};
// 			if(window.parent.donecallback) window.parent.donecallback(response);
// 		</script>
// 		";
// 		Yii::app()->end();
// 	}
// 	static public function error($message,$statusCode='300',$navTabid='',$forwardUrl='',$callbackType='closeCurrent'){
// 		if ($message instanceof CModel){
// 			if ($message->hasErrors()){
// 				$message=preg_replace("/\n/",'',CHtml::errorSummary($message));
// 			}else
// 				$message='';
// 		}
// 		echo "
// 		<script type='text/javascript'>
// 			var statusCode='$statusCode';
// 			var message='$message';
// 			var navTabId='$navTabid';
// 			var forwardUrl='$forwardUrl';
// 			var callbackType='$callbackType';

// 			var response = {statusCode:statusCode,
// 				message:message,
// 				navTabId:navTabId,
// 				forwardUrl:forwardUrl,
// 				callbackType:callbackType
// 			};
// 			if(window.parent.donecallback) window.parent.donecallback(response);
// 		</script>
// 		";
// 	}
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