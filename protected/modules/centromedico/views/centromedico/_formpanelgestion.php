<?php
/* @var $this CentromedicoController */
/* @var $model Afiliado */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'centro-medico-panel-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	
)); ?>	
	<?php echo $form->errorSummary($model); ?>
	<fieldset>
		<?php echo $form->textFieldRow($model,'empleado', array('class'=>'span8')); ?>		
	<fieldset>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>Yii::t("general","Buscar"))); ?>		
	</div>
	

<?php $this->endWidget(); ?>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
            'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    )); ?>

<?php 
if($dataProvider && count($dataProvider->getItemCount()) > 0) {
	$this->widget('bootstrap.widgets.TbGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'empresa-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,
	'columns'=>array(		
		'empleado.emp_nombre',
		'usuario.username',
		'empresa.emp_nombre',
		'motivo.mot_nombre',
		'formato.for_nombre',		
		'cag_fechacreacion',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'htmlOptions'=>array('style'=>'width: 50px'),			
			'template'=>'{download}',
			'buttons'=>array
			(
				'download' => array
				(
					'label'=>'Descargar archivo',
					'imageUrl'=>Yii::app()->theme->baseUrl.'/img/down.png',
					'url'=>'Yii::app()->createUrl("/cartasgeneradas/cartasgeneradas/descargarPorAfiliado", array("id"=>$data->cag_codigo))',
				),				
			),
		),	
	),
)); 
}
?>

</div><!-- form -->
