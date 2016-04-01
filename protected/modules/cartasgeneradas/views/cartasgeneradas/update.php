<?php
/* @var $this CartasgeneradasController */
/* @var $model Cartasgeneradas */

$this->breadcrumbs=array(
	'Cartasgeneradases'=>array('index'),
	$model->cge_codigo=>array('view','id'=>$model->cge_codigo),
	'Update',
);

$this->menu=array(
	array('label'=>'List Cartasgeneradas', 'url'=>array('index')),
	array('label'=>'Create Cartasgeneradas', 'url'=>array('create')),
	array('label'=>'View Cartasgeneradas', 'url'=>array('view', 'id'=>$model->cge_codigo)),
	array('label'=>'Manage Cartasgeneradas', 'url'=>array('admin')),
);
?>

<h1>Update Cartasgeneradas <?php echo $model->cge_codigo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>