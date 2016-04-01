<?php
/* @var $this AfiliadoxempresaController */
/* @var $model Afiliadoxempresa */

$this->breadcrumbs=array(
	'Afiliadoxempresas'=>array('index'),
	$model->axe_codigo,
);

$this->menu=array(
	array('label'=>'List Afiliadoxempresa', 'url'=>array('index')),
	array('label'=>'Create Afiliadoxempresa', 'url'=>array('create')),
	array('label'=>'Update Afiliadoxempresa', 'url'=>array('update', 'id'=>$model->axe_codigo)),
	array('label'=>'Delete Afiliadoxempresa', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->axe_codigo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Afiliadoxempresa', 'url'=>array('admin')),
);
?>

<h1>View Afiliadoxempresa #<?php echo $model->axe_codigo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'axe_codigo',
		'axe_emp_codigo',
		'axe_afi_codigo',
	),
)); ?>
