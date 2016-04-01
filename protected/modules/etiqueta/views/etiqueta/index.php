<?php
/* @var $this EtiquetaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Campos',
);

$this->menu=array(
	array('label'=>'Create Campo', 'url'=>array('create')),
	array('label'=>'Manage Campo', 'url'=>array('admin')),
);
?>

<h1>Campos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
