<?php
/* @var $this MotivoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Motivos',
);

$this->menu=array(
	array('label'=>'Create Motivo', 'url'=>array('create')),
	array('label'=>'Manage Motivo', 'url'=>array('admin')),
);
?>

<h1>Motivos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
