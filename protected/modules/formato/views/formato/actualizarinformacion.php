<?php
/* @var $this ExempleadoController */
/* @var $model Exempleado */

$this->breadcrumbs=array(
	'Formatos'=>array('index'),
	$model->for_nombrearchivo=>array('view','id'=>$model->for_codigo),
	'Actualilzar',
);

$this->menu=array(
	array('label'=>'Administrar formatos', 'url'=>array('admin')),
);
?>

<h1>Actualizar formato <?php echo $model->for_nombrearchivo; ?></h1>
<div id="ayuda">
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h4>Información</h4>
	</div>
 
	<div class="modal-body">
		<p>Ingrese un nombre con el cual pueda reconocer 
		facilmente el formato.</p>
		<p>Este nombre se usa en la pantalla de descarga de cartas.</p>		
	</div>
 
	<div class="modal-footer">   
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'Close',
			'url'=>'#',
			'htmlOptions'=>array('data-dismiss'=>'modal'),
		)); ?>
	</div>
 
<?php $this->endWidget(); ?>
 <span>
	 <?php $this->widget('bootstrap.widgets.TbLabel', array(
		'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
		'label'=>'Ayuda',
		'htmlOptions'=>array(
        'data-toggle'=>'modal',
        'data-target'=>'#myModal',
    ),
	)); ?>   
 </div>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'formato-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'for_nombre'); ?>
		<?php echo $form->textField($model,'for_nombre'); ?>
		<?php echo $form->error($model,'for_nombre'); ?>
	</div>
		<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
