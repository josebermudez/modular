<?php
/* @var $this FormatoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Formatos',
);

$this->menu=array(
	array('label'=>'Create Formato', 'url'=>array('create')),
	array('label'=>'Manage Formato', 'url'=>array('admin')),
);
?>

<h1>Formatos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
