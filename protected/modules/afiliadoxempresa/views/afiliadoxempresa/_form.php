<?php
/* @var $this AfiliadoxempresaController */
/* @var $model Afiliadoxempresa */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'afiliadoxempresa-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'axe_emp_codigo'); ?>
		<?php echo $form->textField($model,'axe_emp_codigo'); ?>
		<?php echo $form->error($model,'axe_emp_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'axe_afi_codigo'); ?>
		<?php echo $form->textField($model,'axe_afi_codigo'); ?>
		<?php echo $form->error($model,'axe_afi_codigo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->