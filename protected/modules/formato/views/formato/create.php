<?php
/* @var $this FormatoController */
/* @var $model Formato */

$this->breadcrumbs=array(
	'Formatos'=>array('index'),
	'Agregar',
);

$this->menu=array(
	array('label'=>'Administrar Formatos', 'url'=>array('admin')),
);
?>

<h1>Agregar formatos</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
