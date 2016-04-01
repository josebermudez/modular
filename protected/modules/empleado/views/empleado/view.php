<?php
/* @var $this EmpleadoController */
/* @var $model Empleado */

$this->breadcrumbs=array(
	'Empleados'=>array('index'),
	$model->emp_numerodocumento,
);
$this->menu=array(
	array('label'=>'Crear empleado', 'url'=>array('create'), 'visible'=>Yii::app()->user->checkAccess('action_empleado_empleado_create')),
	array('label'=>'Actualizar empleado', 'url'=>array('update', 'id'=>$model->emp_codigo),'visible'=>Yii::app()->user->checkAccess('action_empleado_empleado_update')),
	array('label'=>'Borrar empleado', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->emp_codigo),'confirm'=>Yii::t('general','Esta seguro que quiere eliminar el registro'.'?')),'visible'=>Yii::app()->user->checkAccess('action_empleado_empleado_delete')),
	array('label'=>'Administrar empleado', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('general','Ver empleado' ); ?> <i><?php echo $model->emp_nombre; ?></i></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(		
		'empresa.emp_nombre',
		'emp_numerodocumento',
		'emp_nombre',
		'emp_tipodocumento',
		'emp_direccion',
		'emp_telefonofijo',
		'emp_telefonomovil',
		'emp_estado',		
	),
)); ?>
