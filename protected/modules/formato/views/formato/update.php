<?php
/* @var $this FormatoController */
/* @var $model Formato */

$this->breadcrumbs=array(
	'Formatos'=>array('index'),
	$model->for_codigo=>array('view','id'=>$model->for_codigo),
	'Update',
);

$this->menu=array(
	array('label'=>'List Formato', 'url'=>array('index')),
	array('label'=>'Create Formato', 'url'=>array('create')),
	array('label'=>'View Formato', 'url'=>array('view', 'id'=>$model->for_codigo)),
	array('label'=>'Manage Formato', 'url'=>array('admin')),
);
?>

<h1>Update Formato <?php echo $model->for_codigo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>