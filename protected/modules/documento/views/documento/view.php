<?php
/* @var $this DocumentoController */
/* @var $model Documento */

$this->breadcrumbs=array(
	'Documentos'=>array('index'),
	$model->doc_codigo,
);

$this->menu=array(
	array('label'=>'List Documento', 'url'=>array('index')),
	array('label'=>'Create Documento', 'url'=>array('create')),
	array('label'=>'Update Documento', 'url'=>array('update', 'id'=>$model->doc_codigo)),
	array('label'=>'Delete Documento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->doc_codigo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Documento', 'url'=>array('admin')),
);
?>

<h1>View Documento #<?php echo $model->doc_codigo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'doc_codigo',
		'doc_nombre',
		'doc_usr_codigo',
		'doc_empr_codigo',
		'doc_fechacreacion',
	),
)); ?>
