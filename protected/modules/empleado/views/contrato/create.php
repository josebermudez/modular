<?php
/* @var $this EmpleadoController */
/* @var $model Empleado */

$this->breadcrumbs=array(
	'Empleados'=>array('index'),
    $model->empleado->getAttribute('emp_nombre')=>Yii::app()->createUrl("empleado/empleado/admin", array("id"=>$model->getAttribute('con_emp_id'))),    
	'Crear',
);

$this->menu=array(	
	array('label'=>'Administrar contratos', 'url'=>array('admin','id'=>$model->getAttribute('con_emp_id'))),
);
?>

<h1>Agregar contrato</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
