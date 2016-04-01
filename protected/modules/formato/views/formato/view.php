<?php
/* @var $this FormatoController */
/* @var $model Formato */

$this->breadcrumbs=array(
	'Formatos'=>array('index'),
	$model->for_codigo,
);

$this->menu=array(
	array('label'=>'List Formato', 'url'=>array('index')),
	array('label'=>'Create Formato', 'url'=>array('create')),
	array('label'=>'Update Formato', 'url'=>array('update', 'id'=>$model->for_codigo)),
	array('label'=>'Delete Formato', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->for_codigo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Formato', 'url'=>array('admin')),
);
?>

<h1>View Formato #<?php echo $model->for_codigo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'for_codigo',
		'for_nombre',
		'for_texto',
	),
)); ?>
