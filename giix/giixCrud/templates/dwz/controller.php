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

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, '<?php echo $this->modelClass; ?>'),
		));
	}

	public function actionCreate() {
		$model = new <?php echo $this->modelClass; ?>;

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
				if (DwzHelper::IsDwzAjaxRequest())
					$this->dwzOk('保存成功！');
			}
		}

		$this->render('create', array( 'model' => $model));
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
				//$this->redirect(array('view', 'id' => $model-><?php echo $this->tableSchema->primaryKey; ?>));
				$this->dwzOk('更新完成！');//要自动刷新就把后面的mArticle改成你的navTablId(就是打开navTab的链接中的rel)不用刷新可直接调用$this->dwz();即可

			}else
				$this->dwzError($model);

		}

		$this->render('update', array(
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
					$this->dwzOk('删除成功！',200,'');
				
					
			}
		} else
			$this->dwzError('Your request is invalid.',300);
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('<?php echo $this->modelClass; ?>');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new <?php echo $this->modelClass; ?>('search');
		$model->unsetAttributes();

		if (isset($_GET['<?php echo $this->modelClass; ?>']))
			$model->setAttributes($_GET['<?php echo $this->modelClass; ?>']);

		$this->render((DwzHelper::IsDwzAjaxRequest()?'dwzadmin':'admin'), array(
			'model' => $model,
		));
	}


}