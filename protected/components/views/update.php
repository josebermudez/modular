<?php
if($model instanceof Empleado && $model->validate() === false):
$idModal = uniqid();
$this->beginWidget('bootstrap.widgets.TbModal', 
		array(
			'id'=>$idModal,
			'autoOpen'=>true,
			'options'=>array(
				'backdrop'=>'static',
				'keyboard'=>'false'
			)
	)
); 
?>
<div class="modal-header">
    <!---<a class="close" data-dismiss="modal">&times;</a>-->
    <h4>Información del usuario</h4>
    <h5>Ingrese los siguientes datos:</h5>
</div>
 
<div class="modal-body">
   <div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'empleado-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requiridos.</p>

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
		<?php echo $form->labelEx($model,'emp_emp_codigo'); ?>
		<?php 
			$this->widget(
				'bootstrap.widgets.TbSelect2',				 
				array(
					'model' => $model,
					'attribute' => 'emp_emp_codigo',
					'data' => CHtml::listData(Empresa::Model()->findAll(),'emp_codigo','emp_nombre'),
					'htmlOptions' => array(
						'class'=>'span8'					
				),
			)			
			);
		?>			
		<?php echo $form->error($model,'emp_emp_nombre'); ?>
	</div>
		
	<div class="row">
		<?php echo $form->labelEx($model,'emp_nombre'); ?>
		<?php echo $form->textField($model,'emp_nombre',array('rows'=>6, 'cols'=>50,'readonly'=>empty($model->emp_nombre)?false:true)); ?>		
		<?php echo $form->error($model,'emp_nombre'); ?>
	</div>	
	
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'emp_direccion'); ?>
		<?php echo $form->textField($model,'emp_direccion',array('rows'=>6, 'cols'=>50,'readonly'=>empty($model->emp_direccion)?false:true)); ?>
		<?php echo $form->error($model,'emp_direccion'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'emp_email'); ?>
		<?php echo $form->textField($model,'emp_email',array('rows'=>6, 'cols'=>50,'readonly'=>empty($model->emp_email)?false:true)); ?>
		<?php echo $form->error($model,'emp_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'emp_telefonofijo'); ?>
		<?php echo $form->textField($model,'emp_telefonofijo',array('rows'=>6, 'cols'=>50,'readonly'=>empty($model->emp_telefonofijo)?false:true)); ?>
		<?php echo $form->error($model,'emp_telefonofijo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'emp_telefonomovil'); ?>
		<?php echo $form->textField($model,'emp_telefonomovil',array('rows'=>6, 'cols'=>50,'readonly'=>empty($model->emp_telefonomovil)?false:true)); ?>
		<?php echo $form->error($model,'emp_telefonomovil'); ?>
	</div>
	
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>
</div><!-- form -->
</div>
 
<div class="modal-footer">   
</div>


<?php 
$this->endWidget(); 
$this->endWidget();
endif;
?>


