<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>

<div class="pageContent">
<?php $ajax = ($this->enable_ajax_validation) ? 'true' : 'false'; ?>

<?php echo '<?php '; ?>
$form = $this->beginWidget('DwGxActiveForm', array(
	'id' => '<?php echo $this->class2id($this->modelClass); ?>-form',
	'enableAjaxValidation' => <?php echo $ajax; ?>,
	'htmlOptions'=>array(
         'class' => 'pageForm required-validate',
         'onsubmit'=>'return validateCallback(this,dialogAjaxDone)'
    )

));
<?php echo '?>'; ?>



	<div class="pageFormContent" layoutH="56">

<?php foreach ($this->tableSchema->columns as $column): ?>
<?php if (!$column->autoIncrement): ?>
		<dl>
		<?php echo "<?php echo " . $this->generateActiveLabel($this->modelClass, $column) . "; ?>\n"; ?>
		<dd><?php echo "<?php echo \$form->textField(\$model, '{$column->name}',array('readOnly'=>'readOnly')); ?>\n"; ?>
		<?php echo '<?php echo $form->info(); ?>'?></dd>
		</dl>
<?php endif; ?>
<?php endforeach; ?>
	   
<?php foreach ($this->getRelations($this->modelClass) as $relation): ?>
<?php if ($relation[1] == GxActiveRecord::HAS_MANY || $relation[1] == GxActiveRecord::MANY_MANY): ?>
		<label><?php echo '<?php'; ?> echo GxHtml::encode($model->getRelationLabel('<?php echo $relation[0]; ?>')); ?></label>
		<?php echo '<?php ' . $this->generateActiveRelationField($this->modelClass, $relation ,"array('readOnly'=>'readOnly')") . "; ?>\n"; ?>
<?php endif; ?>
<?php endforeach; ?>
	</div>


<?php echo '<?php 
	$this->endWidget(); ?>'; ?>
</div><!-- form -->