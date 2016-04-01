<?php
/* @var $this ExempleadoController */
/* @var $model Exempleado */

$this->breadcrumbs=array(
	'Exempleados'=>array('index'),
	$model->exm_codigo=>array('view','id'=>$model->exm_codigo),
	'Update',
);

$this->menu=array(
	array('label'=>'List Exempleado', 'url'=>array('index')),
	array('label'=>'Create Exempleado', 'url'=>array('create')),
	array('label'=>'View Exempleado', 'url'=>array('view', 'id'=>$model->exm_codigo)),
	array('label'=>'Manage Exempleado', 'url'=>array('admin')),
);
?>

<h1>Update Exempleado <?php echo $model->exm_codigo; ?></h1>

<?php $this->renderPartial('_form', array(
	'model'=>$model,
	'modelEmpleado'=>$modelEmpleado,		
	)); ?>
