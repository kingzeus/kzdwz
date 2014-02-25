<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>

<?php echo "<?php\n"; ?>
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
<?php echo '?>'; ?>