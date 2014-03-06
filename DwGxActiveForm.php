<?php

/**
 * GxActiveForm class file.
 *
 * @author Rodrigo Coelho <rodrigo@giix.org>
 * @link http://giix.org/
 * @copyright Copyright &copy; 2010-2011 Rodrigo Coelho
 * @license http://giix.org/license/ New BSD License
 */

/**
 * GxActiveForm provides forms with additional features.
 *
 * @author Rodrigo Coelho <rodrigo@giix.org>
 */
class DwGxActiveForm extends CActiveForm {

	/**
	 * Renders a checkbox list for a model attribute.
	 * This method is a wrapper of {@link GxHtml::activeCheckBoxList}.
	 * #MethodTracker
	 * This method is based on {@link CActiveForm::checkBoxList}, from version 1.1.7 (r3135). Changes:
	 * <ul>
	 * <li>Uses GxHtml.</li>
	 * </ul>
	 * @see CActiveForm::checkBoxList
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $data Value-label pairs used to generate the check box list.
	 * @param array $htmlOptions Addtional HTML options.
	 * @return string The generated check box list.
	 */
	public function checkBoxList($model, $attribute, $data, $htmlOptions = array()) {
		return GxHtml::activeCheckBoxList($model, $attribute, $data, $htmlOptions);
	}
	/**
	 * Renders a text field for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeTextField}.
	 * Please check {@link CHtml::activeTextField} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated input field
	 */
	public function textField($model,$attribute,$htmlOptions=array())
	{
		if($model->isAttributeRequired($attribute)){
			if(isset($htmlOptions['class']))
				$htmlOptions['class'].=' required';
			else
				$htmlOptions['class']='required';
		}
		self::addValidateAttr($model,$attribute,$htmlOptions);
		return parent::TextField($model,$attribute,$htmlOptions);
	}
	/**
	 * Renders a text area for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeTextArea}.
	 * Please check {@link CHtml::activeTextArea} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated text area
	 */
	public function textArea($model,$attribute,$htmlOptions=array())
	{
		if($model->isAttributeRequired($attribute)){
			if(isset($htmlOptions['class']))
				$htmlOptions['class'].=' required';
			else
				$htmlOptions['class']='required';
		}
		self::addValidateAttr($model,$attribute,$htmlOptions);
		return parent::TextArea($model,$attribute,$htmlOptions);
	}
	
	public function labelEx($model,$attribute,$htmlOptions=array())
	{
		
		$realAttribute=$model->getAttributeLabel($attribute);
		CHtml::resolveName($model,$attribute); // strip off square brackets if any
		$realAttribute=$realAttribute.':';
		return CHtml::tag('dt',$htmlOptions,$realAttribute);
	}
	public function info()
	{
		return CHtml::tag('span',array('class'=>'info'));
	}
	
	
	private static function addValidateAttr($model,$attribute,&$htmlOptions){
		$rules=$model->rules();
		 
		foreach($rules as $rule){
			if($rule[1]=='required')
				continue;
			$attrArr=explode(',', str_replace(' ','',$rule[0]));
			if(in_array($attribute, $attrArr)){
				if($rule[1]=='numerical'){
					if(isset($rule['integerOnly'])){
						if(isset($htmlOptions['class']))
							$htmlOptions['class'].=' digits';
						else
							$htmlOptions['class']='digits';
					}
					else{
						if(isset($htmlOptions['class']))
							$htmlOptions['class'].=' number';
						else
							$htmlOptions['class']='number';
					}
					if(isset($rule['min']))
						$htmlOptions['min']=$rule['min'];
					if(isset($rule['max']))
						$htmlOptions['max']=$rule['max'];
				}
				else if($rule[1]=='length'){
					if(isset($rule['min']))
						$htmlOptions['minlength']=$rule['min'];
					if(isset($rule['max']))
						$htmlOptions['maxlength']=$rule['max'];
				}
			}
		}
	}
}