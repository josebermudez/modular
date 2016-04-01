<?php
/* @var $this EtiquetaController */
/* @var $model Campo */

$this->breadcrumbs=array(
	'Campos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Campo', 'url'=>array('index')),
	array('label'=>'Manage Campo', 'url'=>array('admin')),
);
?>

<h1>Create Campo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>