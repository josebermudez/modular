<?php
/* @var $this CartasgeneradasController */
/* @var $model Cartasgeneradas */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cartasgeneradas-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cag_emp_codigo'); ?>
		<?php echo $form->textField($model,'cag_emp_codigo'); ?>
		<?php echo $form->error($model,'cag_emp_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cag_usr_codigo'); ?>
		<?php echo $form->textField($model,'cag_usr_codigo'); ?>
		<?php echo $form->error($model,'cag_usr_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cag_empr_codigo'); ?>
		<?php echo $form->textField($model,'cag_empr_codigo'); ?>
		<?php echo $form->error($model,'cag_empr_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cag_archivo'); ?>
		<?php echo $form->textField($model,'cag_archivo',array('size'=>60,'maxlength'=>400)); ?>
		<?php echo $form->error($model,'cag_archivo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cag_fechacreacion'); ?>
		<?php echo $form->textField($model,'cag_fechacreacion'); ?>
		<?php echo $form->error($model,'cag_fechacreacion'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->