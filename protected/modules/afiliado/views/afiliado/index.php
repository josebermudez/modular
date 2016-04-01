<?php
/* @var $this AfiliadoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Afiliados',
);

$this->menu=array(
	array('label'=>'Create Afiliado', 'url'=>array('create')),
	array('label'=>'Manage Afiliado', 'url'=>array('admin')),
);
?>

<h1>Afiliados</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
