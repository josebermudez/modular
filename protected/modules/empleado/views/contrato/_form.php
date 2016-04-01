<?php
/* @var $this EmpleadoController */
/* @var $model Empleado */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'contrato-form',	 
	 'type' => 'horizontal',
	 'htmlOptions' => array('enctype' => 'multipart/form-data'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	//'enableClientValidation'=>true,
    //'htmlOptions'=>array('class'=>'well')       
)); ?>
 <fieldset> 
<legend><p class="note"><?php echo Yii::t('general','Campos con'); ?> <span class="required">*</span> <?php echo Yii::t('general','son requiridos') ?>.</p></legend>	
	<?php echo $form->errorSummary($model); ?>
		
		
		 <?php echo $form->datepickerRow(
			$model,
				'con_fechainicio',
					array(
						'options' => array(
						'language' => 'es',
						'altFormat' =>'yyyy-mm-dd'
					),
						'htmlOptions' => array(
						'hint' => Yii::t('general','Ingrese la fecha de inicio de contrato'),
					)
					),
					array(
					'prepend' => '<i class="icon-calendar"></i>'
				)
			); ?>			
	
	
		<?php echo $form->checkBoxRow($model, 'con_esindefinido'); ?>			
	
		 <?php echo $form->datepickerRow(
			$model,
				'con_fechafin',
					array(
						'options' => array(
							'language' => 'es',
							'altFormat' => 'yyyy-mm-dd'
						),
						'htmlOptions' => array(
							'hint' => Yii::t('general','Ingrese la fecha de inicio de contrato'),
						)
					),
					array(
					'prepend' => '<i class="icon-calendar"></i>'
				)
			); ?>		
	<?php echo $form->fileFieldRow($model, 'con_documento'); ?>	
	 <?php echo $form->textFieldRow(
			$model,
			'con_avisarantesde',
			array('hint' => 'Ingrese el número de días para recordar el vencimiento')
		); 
	?>	
		<?php echo $form->checkBoxRow($model, 'con_avisarvencimiento'); ?>					
		<?php echo $form->checkBoxRow($model, 'con_avisarjefe'); ?>					
		<?php echo $form->checkBoxRow($model, 'con_avisarempleado'); ?>					
		<?php echo $form->checkBoxRow($model, 'con_enviarcorreelectronico'); ?>		
		<?php echo $form->checkBoxRow($model, 'con_terminado'); ?>				
		<?php echo $form->hiddenField($model,'con_emp_id'); ?>	
	<?php 
	$this->widget(
        'bootstrap.widgets.TbButton',
        array('buttonType' => 'submit', 'label' => $model->isNewRecord ? Yii::t('general','Crear') : Yii::t('general','Editar'))
    );	
    ?>
     </fieldset>
<?php $this->endWidget(); ?>

</div><!-- form -->
<?php echo CHtml::script("
	function validarContratoIndefinido(status)
	{
		if(status === true) {
			
		}
	}
	
	function cambiarValorToggle(id,value)
	{
		jQuery('input#'+id).val(value);
		if(value === 1) {
			jQuery('input#'+id).parent().css('left','0');
		} else {
			jQuery('input#'+id).parent().css('left','-50%');	
		}				
	}
"); ?>
