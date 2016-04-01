<?php
/* @var $this MotivoController */
/* @var $model Motivo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'mot_codigo'); ?>
		<?php echo $form->textField($model,'mot_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mot_nombre'); ?>
		<?php echo $form->textArea($model,'mot_nombre',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mot_fechacreacion'); ?>
		<?php echo $form->textArea($model,'mot_fechacreacion',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mot_emp_codigo'); ?>
		<?php echo $form->textField($model,'mot_emp_codigo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->