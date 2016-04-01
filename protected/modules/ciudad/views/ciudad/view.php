<?php
/* @var $this CiudadController */
/* @var $model Ciudad */

$this->breadcrumbs=array(
	'Ciudads'=>array('index'),
	$model->ciu_codigo,
);

$this->menu=array(
	array('label'=>'List Ciudad', 'url'=>array('index')),
	array('label'=>'Create Ciudad', 'url'=>array('create')),
	array('label'=>'Update Ciudad', 'url'=>array('update', 'id'=>$model->ciu_codigo)),
	array('label'=>'Delete Ciudad', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ciu_codigo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Ciudad', 'url'=>array('admin')),
);
?>

<h1>View Ciudad #<?php echo $model->ciu_codigo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ciu_codigo',
		'ciu_nombre',
		'exm_fechacreacion',
		'ciu_est_codigo',
	),
)); ?>
