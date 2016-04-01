<?php
/* @var $this LicenciaController */
/* @var $model Licencia */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'licencia-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<p class="note"><?php echo Yii::t('general','Campos con') ?><span class="required">*</span> <?php echo Yii::t('general','son requiridos'); ?>.</p>
	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'lic_duracion'); ?>
		<?php echo $form->textField($model,'lic_duracion',array('size'=>4,'maxlength'=>4, 'value'=>Yii::app()->params['tiempoLicenciaPorDefecto'])); ?>
		<?php echo $form->error($model,'lic_duracion'); ?>
	</div>	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::('general','Crear') : Yii::('general','Guardar')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
