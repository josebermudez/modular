<?php
/* @var $this CartasgeneradasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cartasgeneradases',
);

$this->menu=array(
	array('label'=>'Create Cartasgeneradas', 'url'=>array('create')),
	array('label'=>'Manage Cartasgeneradas', 'url'=>array('admin')),
);
?>

<h1>Cartasgeneradases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
