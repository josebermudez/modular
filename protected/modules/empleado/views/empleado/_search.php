<?php
/* @var $this EmpleadoController */
/* @var $model Empleado */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'emp_codigo'); ?>
		<?php echo $form->textField($model,'emp_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'emp_nombre'); ?>
		<?php echo $form->textArea($model,'emp_nombre',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'emp_numerodocumento'); ?>
		<?php echo $form->textArea($model,'emp_numerodocumento',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'emp_tipodocumento'); ?>
		<?php echo $form->textArea($model,'emp_tipodocumento',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'emp_direccion'); ?>
		<?php echo $form->textArea($model,'emp_direccion',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'emp_telefonofijo'); ?>
		<?php echo $form->textArea($model,'emp_telefonofijo',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'emp_telefonomovil'); ?>
		<?php echo $form->textArea($model,'emp_telefonomovil',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'emp_estado'); ?>
		<?php echo $form->textArea($model,'emp_estado',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'emp_emp_codigo'); ?>
		<?php echo $form->textField($model,'emp_emp_codigo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->