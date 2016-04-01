<?php
/* @var $this CiudadController */
/* @var $model Ciudad */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ciudad-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ciu_nombre'); ?>
		<?php echo $form->textField($model,'ciu_nombre',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'ciu_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'exm_fechacreacion'); ?>
		<?php echo $form->textField($model,'exm_fechacreacion'); ?>
		<?php echo $form->error($model,'exm_fechacreacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ciu_est_codigo'); ?>
		<?php echo $form->textField($model,'ciu_est_codigo'); ?>
		<?php echo $form->error($model,'ciu_est_codigo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->