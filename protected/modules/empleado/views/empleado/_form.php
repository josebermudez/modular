<?php
/* @var $this EmpleadoController */
/* @var $model Empleado */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'empleado-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('general','Campos con') ?><span class="required">*</span> <?php echo Yii::t('general','son requiridos'); ?>.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php 
		if(isset($usuario) && is_object($usuario)) :
			echo $form->errorSummary($usuario); 
		endif;
	?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'emp_numerodocumento'); ?>
		<?php if(!$model->isNewRecord): ?>
			<?php echo $form->textField($model,'emp_numerodocumento',array('readonly'=>true)); ?>
		<?php else: ?>
			<?php echo $form->textField($model,'emp_numerodocumento',array('rows'=>6, 'cols'=>50)); ?>
		<?php endif; ?>
		<?php echo $form->error($model,'emp_numerodocumento'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($model,'emp_nombre'); ?>
		<?php echo $form->textField($model,'emp_nombre',array('rows'=>6, 'cols'=>50)); ?>
		<?php $this->widget('application.components.EtiquetaWidget', array(
			'campo' => 'emp_nombre',
			'tabla' => 'empleado'
		)); ?>
		<?php echo $form->error($model,'emp_nombre'); ?>
	</div>	

	<div class="row">
		<?php echo $form->labelEx($model,'emp_tipodocumento'); ?>
		<?php echo $form->textField($model,'emp_tipodocumento',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'emp_tipodocumento'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'emp_direccion'); ?>
		<?php echo $form->textField($model,'emp_direccion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'emp_direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'emp_telefonofijo'); ?>
		<?php echo $form->textField($model,'emp_telefonofijo',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'emp_telefonofijo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'emp_telefonomovil'); ?>
		<?php echo $form->textField($model,'emp_telefonomovil',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'emp_telefonomovil'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'emp_email'); ?>
		<?php echo $form->textField($model,'emp_email',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'emp_email'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('general','Crear') : Yii::t('general','Guardar')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
