<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>


<?php $ajax = ($this->enable_ajax_validation) ? 'true' : 'false'; ?>

<?php echo '<?php '; ?>
$form = $this->beginWidget('DwGxActiveForm', array(
	'id' => '<?php echo $this->class2id($this->modelClass); ?>-form',
	'enableAjaxValidation' => <?php echo $ajax; ?>,
	'htmlOptions'=>array(
         'class' => 'pageForm required-validate',
         'onsubmit'=>'return validateCallback(this,'. ($_REQUEST['target']=='navTab'? 'navTabAjaxDone': 'dialogAjaxDone').')'
    )

));
<?php echo '?>'; ?>


<style>.alert .alertInner .msg{max-height:600px;overflow:visible;}</style>
	

	<div class="form pageFormContent nowrap" style="border-width:0;">

<?php foreach ($this->tableSchema->columns as $column): ?>
<?php if (!$column->autoIncrement): ?>
		<dl>
		<?php echo "<?php echo " . $this->generateActiveLabel($this->modelClass, $column) . "; ?>\n"; ?>
		<dd><?php echo "<?php " . $this->generateActiveField($this->modelClass, $column) . "; ?>\n"; ?></dd>
		</dl>
<?php endif; ?>
<?php endforeach; ?>
	   
<?php foreach ($this->getRelations($this->modelClass) as $relation): ?>
<?php if ($relation[1] == GxActiveRecord::HAS_MANY || $relation[1] == GxActiveRecord::MANY_MANY): ?>
		<label><?php echo '<?php'; ?> echo GxHtml::encode($model->getRelationLabel('<?php echo $relation[0]; ?>')); ?></label>
		<?php echo '<?php ' . $this->generateActiveRelationField($this->modelClass, $relation) . "; ?>\n"; ?>
<?php endif; ?>
<?php endforeach; ?>
	</div>

	<div class="formBar">
		<ul>
			<li><div class="buttonActive"><div class="buttonContent">
				<button type="submit"><?php echo "<?php echo \$model->isNewRecord ? '创建' : '保存'; ?>\n"; ?></button>
			</div></div></li>
			<li>
				<div class="button"><div class="buttonContent">
					<button onclick="<?php echo "<?php echo \$_REQUEST['target']=='navTab'? 'navTab.closeCurrentTab()': '$.pdialog.closeCurrent()';?>"?>" type="Button">取消</button>
				</div></div>
			</li>
		</ul>
	</div>
<?php echo '<?php $this->endWidget(); ?>'; ?>
</div><!-- form -->