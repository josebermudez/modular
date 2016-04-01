<?php
/* @var $this ExempleadoController */
/* @var $model Exempleado */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'exm_codigo'); ?>
		<?php echo $form->textField($model,'exm_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exm_emp_codigo'); ?>
		<?php echo $form->textField($model,'exm_emp_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exm_fechacreacion'); ?>
		<?php echo $form->textField($model,'exm_fechacreacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exm_motivo'); ?>
		<?php echo $form->textArea($model,'exm_motivo',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->