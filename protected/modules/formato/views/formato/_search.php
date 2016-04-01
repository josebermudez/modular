<?php
/* @var $this FormatoController */
/* @var $model Formato */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'for_codigo'); ?>
		<?php echo $form->textField($model,'for_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'for_nombre'); ?>
		<?php echo $form->textArea($model,'for_nombre',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'for_texto'); ?>
		<?php echo $form->textArea($model,'for_texto',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->