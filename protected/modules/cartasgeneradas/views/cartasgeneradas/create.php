<?php
/* @var $this CartasgeneradasController */
/* @var $model Cartasgeneradas */

$this->breadcrumbs=array(
	'Cartasgeneradases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Cartasgeneradas', 'url'=>array('index')),
	array('label'=>'Manage Cartasgeneradas', 'url'=>array('admin')),
);
?>

<h1>Create Cartasgeneradas</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>