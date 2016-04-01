<?php
/* @var $this AfiliadoController */
/* @var $model Afiliado */

$this->breadcrumbs=array(
	'Afiliados'=>array('index'),
	$model->afi_codigo=>array('view','id'=>$model->afi_codigo),
	'Update',
);

$this->menu=array(
	array('label'=>'List Afiliado', 'url'=>array('index')),
	array('label'=>'Create Afiliado', 'url'=>array('create')),
	array('label'=>'View Afiliado', 'url'=>array('view', 'id'=>$model->afi_codigo)),
	array('label'=>'Manage Afiliado', 'url'=>array('admin')),
);
?>

<h1>Update Afiliado <?php echo $model->afi_codigo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>