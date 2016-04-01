<?php
/* @var $this AdministradorController */
/* @var $model Administrador */

$this->breadcrumbs=array(
	'Administradors'=>array('index'),
	$model->adm_codigo,
);

$this->menu=array(
	array('label'=>'List Administrador', 'url'=>array('index')),
	array('label'=>'Create Administrador', 'url'=>array('create')),
	array('label'=>'Update Administrador', 'url'=>array('update', 'id'=>$model->adm_codigo)),
	array('label'=>'Delete Administrador', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->adm_codigo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Administrador', 'url'=>array('admin')),
);
?>

<h1>View Administrador #<?php echo $model->adm_codigo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'adm_codigo',
		'adm_usuario',
		'adm_contrasenia',
		'adm_emp_codigo',
	),
)); ?>
