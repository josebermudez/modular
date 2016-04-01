<?php
/* @var $this AdministradorController */
/* @var $model Administrador */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'adm_codigo'); ?>
		<?php echo $form->textField($model,'adm_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'adm_usuario'); ?>
		<?php echo $form->textArea($model,'adm_usuario',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'adm_contrasenia'); ?>
		<?php echo $form->textArea($model,'adm_contrasenia',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'adm_emp_codigo'); ?>
		<?php echo $form->textField($model,'adm_emp_codigo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->