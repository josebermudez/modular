<?php
/* @var $this AfiliadoController */
/* @var $model Afiliado */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'afi_codigo'); ?>
		<?php echo $form->textField($model,'afi_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'afi_nombre'); ?>
		<?php echo $form->textArea($model,'afi_nombre',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'afi_direccion'); ?>
		<?php echo $form->textArea($model,'afi_direccion',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'afi_telefonos'); ?>
		<?php echo $form->textArea($model,'afi_telefonos',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'afi_numerodocumento'); ?>
		<?php echo $form->textArea($model,'afi_numerodocumento',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'afi_tipodocumento'); ?>
		<?php echo $form->textArea($model,'afi_tipodocumento',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'afi_tipo'); ?>
		<?php echo $form->textField($model,'afi_tipo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->