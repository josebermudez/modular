<?php
/* @var $this ExempleadoController */
/* @var $model Exempleado */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'exempleado-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->errorSummary($modelEmpleado); ?>

<div class="row">
		<?php echo $form->labelEx($modelEmpleado,'emp_numerodocumento'); ?>
		<?php if(!$model->isNewRecord): ?>
			<?php echo $form->textField($modelEmpleado,'emp_numerodocumento',array('readonly'=>true)); ?>
		<?php else: ?>
			<?php echo $form->textField($modelEmpleado,'emp_numerodocumento',array('rows'=>6, 'cols'=>50)); ?>
		<?php endif; ?>
		<?php echo $form->error($modelEmpleado,'emp_numerodocumento'); ?>
	</div>
	<?php if ($noExisteEmpleado === true) : ?>

	<div class="row">
		<?php echo $form->labelEx($modelEmpleado,'emp_nombre'); ?>
		<?php echo $form->textField($modelEmpleado,'emp_nombre',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($modelEmpleado,'emp_nombre'); ?>
	</div>	

	<div class="row">
		<?php echo $form->labelEx($modelEmpleado,'emp_tipodocumento'); ?>
		<?php echo $form->textField($modelEmpleado,'emp_tipodocumento',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($modelEmpleado,'emp_tipodocumento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelEmpleado,'emp_direccion'); ?>
		<?php echo $form->textField($modelEmpleado,'emp_direccion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($modelEmpleado,'emp_direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelEmpleado,'emp_telefonofijo'); ?>
		<?php echo $form->textField($modelEmpleado,'emp_telefonofijo',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($modelEmpleado,'emp_telefonofijo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($modelEmpleado,'emp_telefonomovil'); ?>
		<?php echo $form->textField($modelEmpleado,'emp_telefonomovil',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($modelEmpleado,'emp_telefonomovil'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($modelEmpleado,'emp_email'); ?>
		<?php echo $form->textField($modelEmpleado,'emp_email',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($modelEmpleado,'emp_email'); ?>
	</div>
<?php endif; ?>
	<div class="row">
		<?php echo $form->labelEx($model,'exm_motivo'); ?>
		<?php echo $form->textArea($model,'exm_motivo',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'exm_motivo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
