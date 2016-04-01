<?php
/* @var $this MotivoController */
/* @var $model Motivo */

$this->breadcrumbs=array(
	'Motivos'=>array('admin'),
	'Crear',
);

$this->menu=array(	
	array('label'=>'Administrar Motivos', 'url'=>array('admin')),
);
?>

<h1>Crear Motivo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
