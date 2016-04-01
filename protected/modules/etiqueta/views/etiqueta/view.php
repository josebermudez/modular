<?php
/* @var $this EtiquetaController */
/* @var $model Campo */

$this->breadcrumbs=array(
	'Campos'=>array('index'),
	$model->cam_codigo,
);

$this->menu=array(
	array('label'=>'List Campo', 'url'=>array('index')),
	array('label'=>'Create Campo', 'url'=>array('create')),
	array('label'=>'Update Campo', 'url'=>array('update', 'id'=>$model->cam_codigo)),
	array('label'=>'Delete Campo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cam_codigo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Campo', 'url'=>array('admin')),
);
?>

<h1>View Campo #<?php echo $model->cam_codigo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cam_codigo',
		'cam_nombre',
		'cam_label',
		'cam_tipo',
		'cam_tablaasociada',
		'cam_keyllaveasociada',
		'cam_valorllaveasociada',
		'cam_etiqueta',
	),
)); ?>
