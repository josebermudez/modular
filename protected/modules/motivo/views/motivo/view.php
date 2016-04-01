<?php
/* @var $this MotivoController */
/* @var $model Motivo */

$this->breadcrumbs=array(
	'Motivos'=>array('index'),
	$model->mot_codigo,
);

$this->menu=array(
	array('label'=>'List Motivo', 'url'=>array('index')),
	array('label'=>'Create Motivo', 'url'=>array('create')),
	array('label'=>'Update Motivo', 'url'=>array('update', 'id'=>$model->mot_codigo)),
	array('label'=>'Delete Motivo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->mot_codigo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Motivo', 'url'=>array('admin')),
);
?>

<h1>View Motivo #<?php echo $model->mot_codigo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'mot_codigo',
		'mot_nombre',
		'mot_fechacreacion',
		'mot_emp_codigo',
	),
)); ?>
