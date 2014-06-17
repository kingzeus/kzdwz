<?php

/**
 * GxController class file.
 *
 * @author Rodrigo Coelho <rodrigo@giix.org>
 * @link http://giix.org/
 * @copyright Copyright &copy; 2010-2011 Rodrigo Coelho
 * @license http://giix.org/license/ New BSD License
 */

/**
 * GxController is the base class for the generated controllers.
 *
 * @author Rodrigo Coelho <rodrigo@giix.org>
 */
abstract class DwGxController extends GxController {

	/**
	 * Performs the AJAX validation.
	 * #MethodTracker
	 * This method is based on the gii generated method controller::performAjaxValidation, from version 1.1.7 (r3135). Changes:
	 * <ul>
	 * <li>Supports multiple models.</li>
	 * </ul>
	 * @param CModel|array $model The model or array of models to be validated.
	 * @param string $form The name of the form. Optional.
	 */
	protected function performAjaxValidation($model, $form = null) {
		if (Yii::app()->getRequest()->getIsAjaxRequest() && (($form === null) || (array_key_exists('ajax',$_POST) && $_POST['ajax'] == $form))) {
			echo GxActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	/**
	 * This method is invoked right before an action is to be executed (after all possible filters.)
	 * You may override this method to do last-minute preparation for the action.
	 * @param CAction $action the action to be executed.
	 * @return boolean whether the action should be executed.
	 */
	protected function beforeAction($action)
	{
		Yii::app()->setComponents(array(
		'clientScript'=>array(
		'class'=>'ext.dwz.DClientScript',
		),
		));
		if ($this->id=='default' && $action->id=='index')
		{
			$this->layout='dwz';
		}else{
			$this->layout=false;
			Yii::app()->clientScript->registerJQuery=false;
			Yii::app()->getErrorHandler()->errorAction ='admin/default/error';
		}

		return parent::beforeAction($action);
	}
	/**
	 * @return 这个是给dwz界面用的用于返回相应的消息代码
	 */
	protected function dwzOk($message,$statusCode='200',$callbackType='closeCurrent',$appEnd=true)
	{
		dwzHelper::json($message, $statusCode,$callbackType);
		if ($appEnd)
			Yii::app()->end();
	}
	
	/**
	* @return 这个是给dwz界面用的用于返回相应的消息代码
	*/
	protected function dwzError($message,$statusCode='300',$callbackType='closeCurrent',$appEnd=true)
	{
		if ($message instanceof CModel)
		{
			if ($message->hasErrors())
			{
				$message=preg_replace("/[\n\r]/",'',CHtml::errorSummary($message));
			}else
				$message='';
		}
		dwzHelper::json($message, $statusCode,$callbackType);
		if ($appEnd)
			Yii::app()->end();
	}


}