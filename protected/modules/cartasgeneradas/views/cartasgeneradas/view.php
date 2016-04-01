<?php
/* @var $this CartasgeneradasController */
/* @var $model Cartasgeneradas */

$this->breadcrumbs=array(
	'Cartasgeneradases'=>array('index'),
	$model->cge_codigo,
);

$this->menu=array(
	array('label'=>'List Cartasgeneradas', 'url'=>array('index')),
	array('label'=>'Create Cartasgeneradas', 'url'=>array('create')),
	array('label'=>'Update Cartasgeneradas', 'url'=>array('update', 'id'=>$model->cge_codigo)),
	array('label'=>'Delete Cartasgeneradas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cge_codigo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Cartasgeneradas', 'url'=>array('admin')),
);
?>

<h1>View Cartasgeneradas #<?php echo $model->cge_codigo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cge_codigo',
		'cag_emp_codigo',
		'cag_usr_codigo',
		'cag_empr_codigo',
		'cag_archivo',
		'cag_fechacreacion',
	),
)); ?>
