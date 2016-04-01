<?php
/* @var $this EmpresaController */
/* @var $model Empresa */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'emp_nombre'); ?>
		<?php echo $form->textArea($model,'emp_nombre',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'emp_codigo'); ?>
		<?php echo $form->textField($model,'emp_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'emp_direccion'); ?>
		<?php echo $form->textArea($model,'emp_direccion',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'emp_telefono'); ?>
		<?php echo $form->textArea($model,'emp_telefono',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->