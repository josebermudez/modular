<?php
/* @var $this MotivoController */
/* @var $model Motivo */

$this->breadcrumbs=array(
	'Motivos'=>array('index'),
	$model->mot_nombre=>array('view','id'=>$model->mot_codigo),
	'Actualizar',
);

$this->menu=array(	
	array('label'=>'Crear Motivo', 'url'=>array('create')),	
	array('label'=>'Administrar Motivo', 'url'=>array('admin')),
);
?>

<h1>Actualizar Motivo <?php echo $model->mot_nombre; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
