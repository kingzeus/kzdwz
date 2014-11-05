<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseControllerClass; ?> {

<?php 
	$authpath = 'ext.dwz.giix.giixCrud.templates.dwz.auth.';
	Yii::app()->controller->renderPartial($authpath . $this->authtype);
?>

	public function actionCreate() {

        if(!DwzHelper::IsDwzAjaxRequest())
			throw new CHttpException(405,Yii::t('yii','Your method is not allowed.'));
		
		$model = new <?php echo $this->modelClass; ?>;



		if (isset($_POST['<?php echo $this->modelClass; ?>'])) {
			$model->setAttributes($_POST['<?php echo $this->modelClass; ?>']);
<?php if ($this->hasManyManyRelation($this->modelClass)): ?>
			$relatedData = <?php echo $this->generateGetPostRelatedData($this->modelClass, 4); ?>;
<?php endif; ?>

<?php if ($this->hasManyManyRelation($this->modelClass)): ?>
			if ($model->saveWithRelated($relatedData)) {
<?php else: ?>
			if ($model->save()) {
<?php endif; ?>
				
					$this->dwzOk('保存成功！');
			}


		}
		$this->render('dwzcreate', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, '<?php echo $this->modelClass; ?>');

<?php if ($this->enable_ajax_validation): ?>
		$this->performAjaxValidation($model, '<?php echo $this->class2id($this->modelClass)?>-form');
<?php endif; ?>

		if (isset($_POST['<?php echo $this->modelClass; ?>'])) {
			$model->setAttributes($_POST['<?php echo $this->modelClass; ?>']);
<?php if ($this->hasManyManyRelation($this->modelClass)): ?>
			$relatedData = <?php echo $this->generateGetPostRelatedData($this->modelClass, 4); ?>;
<?php endif; ?>

<?php if ($this->hasManyManyRelation($this->modelClass)): ?>
			if ($model->saveWithRelated($relatedData)) {
<?php else: ?>
			if ($model->save()) {
<?php endif; ?>
				
				$this->dwzOk('更新完成！');

			}else
				$this->dwzError($model);

		}

		$this->render('dwzupdate', array(
				'model' => $model,
				));
	}

	public function actionDelete($id=null) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			if($id===null&&isset($_POST['<?php echo $this->tableSchema->primaryKey; ?>']))
			{
				$id = explode(',',$_POST['<?php echo $this->tableSchema->primaryKey; ?>']);
			}
			<?php echo $this->modelClass; ?>::model()->deleteByPk($id);
			

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
			else{
				if(DwzHelper::IsDwzAjaxRequest())
					$this->dwzOk('删除成功！',200,'','','');
				
					
			}
		} else
			$this->dwzError('Your request is invalid.',300);
	}



	public function actionAdmin() {
		if(!DwzHelper::IsDwzAjaxRequest())
			throw new CHttpException(405,Yii::t('yii','Your method is not allowed.'));
		

		$model = new <?php echo $this->modelClass; ?>('search');
		$model->unsetAttributes();

		if (isset($_GET['<?php echo $this->modelClass; ?>']))
			$model->setAttributes($_GET['<?php echo $this->modelClass; ?>']);

		$this->render('dwzadmin', array(
			'model' => $model,
		));
	}


}