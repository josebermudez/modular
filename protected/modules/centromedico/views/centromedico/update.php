<?php
/* @var $this CentromedicoController */
/* @var $model Afiliado */

$this->breadcrumbs=array(
	'Centros médicos'=>array('index'),
	$model->afi_nombre=>array('view','id'=>$model->afi_codigo),
	'Actualizar',
);
$this->menu=array(	
	array('label'=>'Crear centro médico', 'url'=>array('create')),	
	array('label'=>'Administrar centro médico', 'url'=>array('admin')),
);
?>
<h1>Actualizar centro médico <?php echo $model->afi_nombre; ?></h1>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
