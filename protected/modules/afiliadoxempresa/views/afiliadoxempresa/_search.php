<?php
/* @var $this AfiliadoxempresaController */
/* @var $model Afiliadoxempresa */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'axe_codigo'); ?>
		<?php echo $form->textField($model,'axe_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'axe_emp_codigo'); ?>
		<?php echo $form->textField($model,'axe_emp_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'axe_afi_codigo'); ?>
		<?php echo $form->textField($model,'axe_afi_codigo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->