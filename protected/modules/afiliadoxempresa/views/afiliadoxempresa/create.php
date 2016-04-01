<?php
/* @var $this AfiliadoxempresaController */
/* @var $model Afiliadoxempresa */

$this->breadcrumbs=array(
	'Afiliadoxempresas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Afiliadoxempresa', 'url'=>array('index')),
	array('label'=>'Manage Afiliadoxempresa', 'url'=>array('admin')),
);
?>

<h1>Create Afiliadoxempresa</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>