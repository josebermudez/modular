<?php
/* @var $this AfiliadoxempresaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Afiliadoxempresas',
);

$this->menu=array(
	array('label'=>'Create Afiliadoxempresa', 'url'=>array('create')),
	array('label'=>'Manage Afiliadoxempresa', 'url'=>array('admin')),
);
?>

<h1>Afiliadoxempresas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
