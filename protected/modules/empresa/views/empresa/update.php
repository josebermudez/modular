<?php
/* @var $this EmpresaController */
/* @var $model Empresa */

$this->breadcrumbs=array(
	'Empresas'=>array('index'),
	$model->emp_nombre=>array('view','id'=>$model->emp_codigo),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar empresas', 'url'=>array('index')),
	array('label'=>'Crear empresa', 'url'=>array('create')),
	array('label'=>'Ver empresa', 'url'=>array('view', 'id'=>$model->emp_codigo)),
	array('label'=>'Administrar empresas', 'url'=>array('admin')),
);
?>

<h1>Actualizar empresa <i><?php echo $model->emp_nombre; ?></i></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
