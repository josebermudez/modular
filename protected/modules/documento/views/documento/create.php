<?php
/* @var $this DocumentoController */
/* @var $model Documento */

$this->breadcrumbs=array(
	'Documentos'=>array('index'),
	'Agregar',
);
$this->menu=array(	
	array('label'=>'Administrar documentos', 'url'=>array('admin')),
);
?>
<h1>Agregar documento</h1>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
