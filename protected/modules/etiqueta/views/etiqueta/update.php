<?php
/* @var $this EtiquetaController */
/* @var $model Campo */

$this->breadcrumbs=array(
	'Campos'=>array('index'),
	$model->cam_codigo=>array('view','id'=>$model->cam_codigo),
	'Update',
);

$this->menu=array(
	array('label'=>'List Campo', 'url'=>array('index')),
	array('label'=>'Create Campo', 'url'=>array('create')),
	array('label'=>'View Campo', 'url'=>array('view', 'id'=>$model->cam_codigo)),
	array('label'=>'Manage Campo', 'url'=>array('admin')),
);
?>

<h1>Update Campo <?php echo $model->cam_codigo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>