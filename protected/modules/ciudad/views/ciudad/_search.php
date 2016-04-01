<?php
/* @var $this CiudadController */
/* @var $model Ciudad */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ciu_codigo'); ?>
		<?php echo $form->textField($model,'ciu_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ciu_nombre'); ?>
		<?php echo $form->textField($model,'ciu_nombre',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exm_fechacreacion'); ?>
		<?php echo $form->textField($model,'exm_fechacreacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ciu_est_codigo'); ?>
		<?php echo $form->textField($model,'ciu_est_codigo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->