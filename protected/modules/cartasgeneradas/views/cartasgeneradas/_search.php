<?php
/* @var $this CartasgeneradasController */
/* @var $model Cartasgeneradas */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'cge_codigo'); ?>
		<?php echo $form->textField($model,'cge_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cag_emp_codigo'); ?>
		<?php echo $form->textField($model,'cag_emp_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cag_usr_codigo'); ?>
		<?php echo $form->textField($model,'cag_usr_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cag_empr_codigo'); ?>
		<?php echo $form->textField($model,'cag_empr_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cag_archivo'); ?>
		<?php echo $form->textField($model,'cag_archivo',array('size'=>60,'maxlength'=>400)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cag_fechacreacion'); ?>
		<?php echo $form->textField($model,'cag_fechacreacion'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->