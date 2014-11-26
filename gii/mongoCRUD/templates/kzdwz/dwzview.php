<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>

<div class="pageContent">


<?php echo '<?php '; ?>
$form = $this->beginWidget('DwGxActiveForm', array(
	'id' => '<?php echo $this->class2id($this->modelClass); ?>-form',
	'htmlOptions'=>array(
         'class' => 'pageForm required-validate',
         'onsubmit'=>'return validateCallback(this,dialogAjaxDone)'
    )

));
<?php echo '?>'; ?>



	<div class="pageFormContent nowrap" layoutH="56">

<?php foreach ($this->modelObject->attributeNames() as $name): ?>

		<dl>
		<?php echo "<?php echo " . $this->generateActiveLabel($this->modelClass, $name) . "; ?>\n"; ?>
		<dd><?php echo "<?php echo " . $this->generateActiveField($this->modelClass, $name) . "; ?>\n"; ?>
		<?php echo '<?php echo $form->info(); ?>'?></dd>
		</dl>

<?php endforeach; ?>
	   
	</div>

<?php echo '<?php '; ?> $this->endWidget(); <?php echo '?>'; ?>
</div><!-- form -->