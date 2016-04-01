<?php
/* @var $this CentromedicoController */
/* @var $model Afiliado */
$this->breadcrumbs=array(
	'Centros médicos'=>array('index'),
	'Crear',
);
$this->menu=array(	
	array('label'=>'Administra centros médicos', 'url'=>array('admin')),
);
?>
<h1>Crear centro médico</h1>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
