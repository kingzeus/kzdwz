<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseControllerClass; ?> {

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionCreate() {

        if(!DwzHelper::IsDwzAjaxRequest())
			throw new CHttpException(405,Yii::t('yii','Your method is not allowed.'));
		
		$model = new <?php echo $this->modelClass; ?>;



		if (isset($_POST['<?php echo $this->modelClass; ?>'])) {
			$model->setAttributes($_POST['<?php echo $this->modelClass; ?>']);

			if ($model->save()) {
					$this->dwzOk('保存成功！');
			}


		}
		$this->render('dwzcreate', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, '<?php echo $this->modelClass; ?>');

		if (isset($_POST['<?php echo $this->modelClass; ?>'])) {
			$model->setAttributes($_POST['<?php echo $this->modelClass; ?>']);

			if ($model->save()) {
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
			$this->loadModel($id)->delete();

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