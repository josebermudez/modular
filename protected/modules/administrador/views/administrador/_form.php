<?php
/* @var $this AdministradorController */
/* @var $model Administrador */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'administrador-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'adm_usuario'); ?>
		<?php echo $form->textArea($model,'adm_usuario',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'adm_usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'adm_contrasenia'); ?>
		<?php echo $form->textArea($model,'adm_contrasenia',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'adm_contrasenia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'adm_emp_codigo'); ?>
		<?php echo $form->textField($model,'adm_emp_codigo'); ?>
		<?php echo $form->error($model,'adm_emp_codigo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->