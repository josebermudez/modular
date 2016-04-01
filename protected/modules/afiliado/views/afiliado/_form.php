<?php
/* @var $this AfiliadoController */
/* @var $model Afiliado */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'afiliado-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'afi_nombre'); ?>
		<?php echo $form->textArea($model,'afi_nombre',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'afi_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'afi_direccion'); ?>
		<?php echo $form->textArea($model,'afi_direccion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'afi_direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'afi_telefonos'); ?>
		<?php echo $form->textArea($model,'afi_telefonos',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'afi_telefonos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'afi_numerodocumento'); ?>
		<?php echo $form->textArea($model,'afi_numerodocumento',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'afi_numerodocumento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'afi_tipodocumento'); ?>
		<?php echo $form->textArea($model,'afi_tipodocumento',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'afi_tipodocumento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'afi_tipo'); ?>
		<?php echo $form->textField($model,'afi_tipo'); ?>
		<?php echo $form->error($model,'afi_tipo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->