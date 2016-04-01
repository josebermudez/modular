<?php
/* @var $this EmpleadoController */
/* @var $model Empleado */

$this->breadcrumbs=array(
	'Empleados'=>array('index'),
	$model->emp_codigo=>array('view','id'=>$model->emp_codigo),
	'Actualizar',
);

$this->menu=array(	
	array('label'=>'Crear empleado', 'url'=>array('create')),
	array('label'=>'Ver empleado', 'url'=>array('view', 'id'=>$model->emp_codigo)),
	array('label'=>'Administrar empleado', 'url'=>array('admin')),
);
?>

<h1>Actualizar Empleado <?php echo $model->emp_codigo; ?></h1>
<?php $this->renderPartial('_form', array('model'=>$model,'usuario'=>$usuario)); ?>
