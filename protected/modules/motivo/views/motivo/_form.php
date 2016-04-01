<?php
/* @var $this MotivoController */
/* @var $model Motivo */
/* @var $form CActiveForm */
?>

<div class="form">
	<?php
	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'motivo-form',
    'type'=>'horizontal',
    // Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'mot_nombre'); ?>
		<?php echo $form->textArea($model,'mot_nombre',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'mot_nombre'); ?>
	</div>	
	<div class="row">
	<?php echo $form->labelEx($model,'mot_formatos'); ?>
	<?php
	
		$this->widget(
			'bootstrap.widgets.TbSelect2',
			array(
				'model' => $model,
				'attribute' => 'mot_formatos',
				'data' => CHtml::listData(Formato::getFormatosEmpresa(), 'for_codigo', 'for_nombrearchivo'),
				'htmlOptions' => array(
				'multiple' => 'multiple',
				'id' => 'issue-574-checker-select'
				),
			)
		);
	?>
	<?php echo $form->error($model,'mot_formatos'); ?>
</div>
<div class="row">
	<?php echo $form->labelEx($model,'roles'); ?>
	<?php
		$dataRoles = Modul4rAuthitem::model()->findAllByAttributes(array('type'=>2));
		
		$this->widget(
			'bootstrap.widgets.TbSelect2',
			array(
				'model' => $model,
				'attribute' => 'roles',
				'data' => CHtml::listData($dataRoles, 'name', 'name'),
				'htmlOptions' => array(
					'multiple' => 'multiple',				
				),
			)
		);
	?>
	<?php echo $form->error($model,'mot_formatos'); ?>
</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
