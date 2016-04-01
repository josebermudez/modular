<?php
/* @var $this DocumentoController */
/* @var $model Documento */

$this->breadcrumbs=array(
	'Documentos'=>array('index'),
	$model->doc_codigo=>array('view','id'=>$model->doc_codigo),
	'Update',
);

$this->menu=array(
	array('label'=>'List Documento', 'url'=>array('index')),
	array('label'=>'Create Documento', 'url'=>array('create')),
	array('label'=>'View Documento', 'url'=>array('view', 'id'=>$model->doc_codigo)),
	array('label'=>'Manage Documento', 'url'=>array('admin')),
);
?>

<h1>Update Documento <?php echo $model->doc_codigo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>