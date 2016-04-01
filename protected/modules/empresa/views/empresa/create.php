<?php
/* @var $this EmpresaController */
/* @var $model Empresa */

$this->breadcrumbs=array(
	'Empresas'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar empresas', 'url'=>array('index')),
	array('label'=>'Administrar empresa', 'url'=>array('admin')),
);
?>

<h1>Crear Empresa</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
