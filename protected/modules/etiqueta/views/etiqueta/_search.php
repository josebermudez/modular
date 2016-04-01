<?php
/* @var $this EtiquetaController */
/* @var $model Campo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'cam_codigo'); ?>
		<?php echo $form->textField($model,'cam_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cam_nombre'); ?>
		<?php echo $form->textField($model,'cam_nombre',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cam_label'); ?>
		<?php echo $form->textField($model,'cam_label',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cam_tipo'); ?>
		<?php echo $form->textField($model,'cam_tipo',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cam_tablaasociada'); ?>
		<?php echo $form->textField($model,'cam_tablaasociada',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cam_keyllaveasociada'); ?>
		<?php echo $form->textField($model,'cam_keyllaveasociada',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cam_valorllaveasociada'); ?>
		<?php echo $form->textField($model,'cam_valorllaveasociada',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cam_etiqueta'); ?>
		<?php echo $form->textField($model,'cam_etiqueta',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->