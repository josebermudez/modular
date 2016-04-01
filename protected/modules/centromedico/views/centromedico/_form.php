<?php
/* @var $this CentromedicoController */
/* @var $model Afiliado */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'afiliado-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
	<fieldset>
	<?php echo $form->textFieldRow($model,'afi_nombre', array('class'=>'span8')); ?>
	<?php echo $form->textFieldRow($model,'afi_direccion', array('class'=>'span8')); ?>
	<?php echo $form->textFieldRow($model,'afi_telefonos', array('class'=>'span8')); ?>
	<?php echo $form->textFieldRow($model,'afi_numerodocumento', array('class'=>'span8')); ?>	
	<?php echo $form->textFieldRow($model,'afi_email', array('class'=>'span8')); ?>	
	<div class="control-group">
	<?php echo $form->labelEx($model,'afi_ciu_codigo',array('class'=>'control-label')); ?>
	<div class="controls">
	<?php 
		$this->widget(
			'bootstrap.widgets.TbSelect2',				 
			array(
				'model' => $model,
				'attribute' => 'afi_ciu_codigo',
				'data' => CHtml::listData(Ciudad::Model()->findAll(),'ciu_codigo','ciu_nombre'),
				'htmlOptions' => array(
					'class'=>'span8'
					//'multiple' => 'multiple',					
			),
		)			
		);
	?>		
	</div></div>	
	<?php echo $form->textFieldRow($model,'afi_horarios', array('class'=>'span8')); ?>
	<fieldset>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Guardar')); ?>		
	</div>
	

<?php $this->endWidget(); ?>

</div><!-- form -->
