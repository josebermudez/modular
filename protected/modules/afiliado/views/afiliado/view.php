<?php
/* @var $this AfiliadoController */
/* @var $model Afiliado */

$this->breadcrumbs=array(
	'Afiliados'=>array('index'),
	$model->afi_codigo,
);

$this->menu=array(
	array('label'=>'List Afiliado', 'url'=>array('index')),
	array('label'=>'Create Afiliado', 'url'=>array('create')),
	array('label'=>'Update Afiliado', 'url'=>array('update', 'id'=>$model->afi_codigo)),
	array('label'=>'Delete Afiliado', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->afi_codigo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Afiliado', 'url'=>array('admin')),
);
?>

<h1>View Afiliado #<?php echo $model->afi_codigo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'afi_codigo',
		'afi_nombre',
		'afi_direccion',
		'afi_telefonos',
		'afi_numerodocumento',
		'afi_tipodocumento',
		'afi_tipo',
	),
)); ?>
