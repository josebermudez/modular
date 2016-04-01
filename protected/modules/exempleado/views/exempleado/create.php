<?php
/* @var $this ExempleadoController */
/* @var $model Exempleado */

$this->breadcrumbs=array(
	'Ex-empleados'=>array('index'),
	'Crear',
);

$this->menu=array(	
	array('label'=>'Administrar ex-empleado', 'url'=>array('admin')),
);
?>

<h1>Crear ex-empleado</h1>

<?php $this->renderPartial('_form', array(
		'model'=>$model,
		'modelEmpleado'=>$modelEmpleado,
		'noExisteEmpleado'=>$noExisteEmpleado
	)
	
	); ?>
