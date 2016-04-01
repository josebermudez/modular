<?php
/* @var $this EmpresaController */
/* @var $model Empresa */
/* @var $form CActiveForm */
?>
<div class="form">
<?php 
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'empresa-form',
    'enableAjaxValidation'=>false,
    'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),    
)); ?>
	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>
	<?php echo $form->errorSummary($model); ?>
	<fieldset>
	<?php echo $form->textFieldRow($model,'emp_nombre', array('class'=>'span8')); ?>		
	<div class="control-group">
	<?php echo $form->labelEx($model,'emp_ciu_codigo',array('class'=>'control-label')); ?>
	<div class="controls">
		<?php 
			$this->widget(
				'bootstrap.widgets.TbSelect2',				 
				array(
					'model' => $model,
					'attribute' => 'emp_ciu_codigo',
					'data' => CHtml::listData(Ciudad::Model()->findAll(),'ciu_codigo','ciu_nombre'),
					'htmlOptions' => array(
						'class'=>'span8'
					//'multiple' => 'multiple',					
				),
			)			
			);
		?>	
		<?php echo $form->error($model,'emp_ciu_codigo'); ?>
	</div></div>	
	<?php echo $form->textFieldRow($model,'emp_direccion', array('class'=>'span8')); ?>
	<?php echo $form->textFieldRow($model,'emp_email', array('class'=>'span8')); ?>
	<div class="control-group">
	<?php echo $form->labelEx($model,'centrosmedicos',array('class'=>'control-label')); ?>
	<div class="controls">
	<?php 
		$this->widget(
			'bootstrap.widgets.TbSelect2',				 
			array(
				'model' => $model,
				'attribute' => 'centrosmedicos',
				'data' => CHtml::listData(Afiliado::Model()->findAllByAttributes(array('afi_tipo'=>1)),'afi_codigo','afi_nombre'),
				'htmlOptions' => array(
					'class'=>'span8',
					'placeholder' => Yii::t('empresa.forms','Seleccion los centros medicos afiliados'),
					//'multiple' => 'multiple',					
			),
		)			
		);
	?>		
	</div></div>	
	
	<div class="control-group">
	<?php echo $form->labelEx($model,'emp_estado',array('class'=>'control-label')); ?>
	<div class="controls">
	<?php 
		$this->widget(
			'bootstrap.widgets.TbSelect2',				 
			array(
				'model' => $model,
				'attribute' => 'emp_estado',
				'data' => array('A'=>'Activo','C'=>'Cerrada'),
				'htmlOptions' => array(
					'class'=>'span8',
					'placeholder' => Yii::t('empresa.forms','Seleccione el estado'),
					//'multiple' => 'multiple',					
			),
		)			
		);
	?>		
	</div></div>
	<div class="controls">
	<?php 
		$this->widget(
			'bootstrap.widgets.TbSelect2',				 
			array(
				'model' => $model,
				'attribute' => 'emp_jefepersonal',
				'data' => CHtml::listData(Empleado::Model()->findAllByAttributes(array('emp_emp_codigo'=>$model->getAttribute('emp_emp_codigo'),'emp_estado'=>'A')),'emp_codigo','emp_nombre'),
				'htmlOptions' => array(
					'class'=>'span8',
					'placeholder' => Yii::t('general','Seleccione el jefe de personal'),					
			),
		)			
		);
	?>		
	</div>
	<?php if(Yii::app()->user->isSuperAdmin): ?>
	<div class="row">		
		<?php echo $form->select2Row(
					$model,
					'emp_lic_codigo',															
					array(					
						'options' => array(							
							'placeholder' => Yii::t('general','Elija la licencia'),
							'width' => '40%',
							'tokenSeparators' => array(',', ' ')
						),					
						'data'=>CHtml::listData(
							Licencia::model()->findAllByAttributes(array(
								//'lic_emp_codigo'=>Yii::app()->user->getState('empresa'),
								'lic_activa' => 1,
						        //'lic_estaenuso'=>0,
							)), 'lic_id', 'lic_codigo'
						)
					)
				);
		
		?>		
	</div>
	<?php endif; ?>
	<?php echo $form->textFieldRow($model,'emp_telefono', array('class'=>'span8')); ?>
	</fieldset>	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Guardar')); ?>		
	</div>					
<?php $this->endWidget(); ?>
</div><!-- form -->
