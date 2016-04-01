<?php
/* @var $this AfiliadoxempresaController */
/* @var $model Afiliadoxempresa */

$this->breadcrumbs=array(
	'Afiliadoxempresas'=>array('index'),
	$model->axe_codigo=>array('view','id'=>$model->axe_codigo),
	'Update',
);

$this->menu=array(
	array('label'=>'List Afiliadoxempresa', 'url'=>array('index')),
	array('label'=>'Create Afiliadoxempresa', 'url'=>array('create')),
	array('label'=>'View Afiliadoxempresa', 'url'=>array('view', 'id'=>$model->axe_codigo)),
	array('label'=>'Manage Afiliadoxempresa', 'url'=>array('admin')),
);
?>

<h1>Update Afiliadoxempresa <?php echo $model->axe_codigo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>