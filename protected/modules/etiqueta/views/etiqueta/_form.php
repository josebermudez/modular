<?php
/* @var $this EtiquetaController */
/* @var $model Campo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'campo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cam_nombre'); ?>
		<?php echo $form->textField($model,'cam_nombre',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'cam_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cam_label'); ?>
		<?php echo $form->textField($model,'cam_label',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'cam_label'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cam_tipo'); ?>
		<?php echo $form->textField($model,'cam_tipo',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'cam_tipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cam_tablaasociada'); ?>
		<?php echo $form->textField($model,'cam_tablaasociada',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'cam_tablaasociada'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cam_keyllaveasociada'); ?>
		<?php echo $form->textField($model,'cam_keyllaveasociada',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'cam_keyllaveasociada'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cam_valorllaveasociada'); ?>
		<?php echo $form->textField($model,'cam_valorllaveasociada',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'cam_valorllaveasociada'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cam_etiqueta'); ?>
		<?php echo $form->textField($model,'cam_etiqueta',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'cam_etiqueta'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->