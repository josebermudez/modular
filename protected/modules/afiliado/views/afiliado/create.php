<?php
/* @var $this AfiliadoController */
/* @var $model Afiliado */

$this->breadcrumbs=array(
	'Afiliados'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Afiliado', 'url'=>array('index')),
	array('label'=>'Manage Afiliado', 'url'=>array('admin')),
);
?>

<h1>Create Afiliado</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>