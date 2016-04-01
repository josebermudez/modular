<?php
/* @var $this DocumentoController */
/* @var $model Documento */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'doc_codigo'); ?>
		<?php echo $form->textField($model,'doc_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'doc_nombre'); ?>
		<?php echo $form->textField($model,'doc_nombre',array('size'=>60,'maxlength'=>400)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'doc_usr_codigo'); ?>
		<?php echo $form->textField($model,'doc_usr_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'doc_empr_codigo'); ?>
		<?php echo $form->textField($model,'doc_empr_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'doc_fechacreacion'); ?>
		<?php echo $form->textField($model,'doc_fechacreacion'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->