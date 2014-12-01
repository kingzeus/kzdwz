<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>



<?php echo '<?php'."\n"; ?>
	$pager = array();
	$pageSize=10;
	$currentPage=0;
	if(isset($_POST['numPerPage']))
	{
		$pager['pageSize'] = $_POST['numPerPage'];
		$pageSize = $_POST['numPerPage'];
	}
	if(isset($_POST['pageNum']))
	{
		$pager['currentPage'] = $_POST['pageNum']-1;
		$currentPage = $_POST['pageNum']-1;
	}
	 $this->widget('ext.dwz.DwzAjaxGridView', array(
	'id' => '<?php echo $this->class2id($this->modelClass); ?>-grid',
	'template'=>"{items}\n{pager}",
	'pageSize'=>$pageSize,
	 'currentPage'=>$currentPage,
	'pager'=>array	(
			'class'=>'DwzPager',
			'showWrap'=>true,
					),
	
	<?php echo "//'showToolbar'=>false,		// 是否显示工具条\n" ?>
	<?php echo "//'showCheckbox'=>false,		// 是否显示多选框\n" ?>
		'toolbar'=>array(
				CHtml::link(CHtml::tag('span',array(),yii::t('admin','Create')),Yii::app()->controller->createUrl('create'),array('class'=>'add','target'=>'dialog')),
				//CHtml::link(CHtml::tag('span',array(),yii::t('zii','Delete')),Yii::app()->controller->createUrl('delete',array('id'=>'{'.$model->getTableSchema()->primaryKey.'}')),array('class'=>'delete','target'=>'ajaxTodo','title'=>Yii::t('zii','Are you sure you want to delete this item?'))),
				CHtml::link(CHtml::tag('span',array(),yii::t('admin','Delete')),Yii::app()->controller->createUrl('delete',array()),array('class'=>'delete','rel'=>$model->getTableSchema()->primaryKey,'target'=>'selectedTodo','posttype'=>'string','title'=>Yii::t('zii','Are you sure you want to delete this item?'))),
				
				CHtml::link(CHtml::tag('span',array(),Yii::t('admin','Update')),Yii::app()->controller->createUrl('update',array('id'=>'{'.$model->getTableSchema()->primaryKey.'}')),array('class'=>'edit','target'=>'dialog')),
				),
	<?php echo "//'showOperationButton'=>false,		// 是否显示操作条\n" ?>
	<?php echo "//'operationReadOnly'=>true,		// 只读模式\n" ?>
	<?php echo "//'showSearchBar'=>false,		// 显示搜索条\n" ?>
	'dataProvider' => $model->search($pager),
	<?php echo "//'showFilter'=>false,		// 显示过滤器\n" ?>
	'filter' => $model,
	'columns' => array(
<?php
$count = 0;
foreach ($this->tableSchema->columns as $column) {
	if (++$count == 7)
		echo "\t\t/*\n";
	echo "\t\t" . $this->generateGridViewColumn($this->modelClass, $column).",\n";
}
if ($count >= 7)
	echo "\t\t*/\n";
?>
	),
)); ?>

